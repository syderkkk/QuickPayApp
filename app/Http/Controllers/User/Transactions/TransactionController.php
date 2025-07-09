<?php

namespace App\Http\Controllers\User\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Transaction::query()
            ->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->where('status', 'completed'); // Solo transacciones completadas

        if ($request->filled('type')) {
            if ($request->type === 'send') {
                $query->where('sender_id', $user->id);
            } elseif ($request->type === 'receive') {
                $query->where('receiver_id', $user->id);
            }
        } else {
            $query->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search, $user) {
                $q->orWhereHas('sender', function ($q2) use ($search, $user) {
                    $q2->where('id', '!=', $user->id)
                        ->where(function ($q3) use ($search) {
                            $q3->where('name', 'like', "%$search%")
                                ->orWhere('email', 'like', "%$search%");
                        });
                })
                    ->orWhereHas('receiver', function ($q2) use ($search, $user) {
                        $q2->where('id', '!=', $user->id)
                            ->where(function ($q3) use ($search) {
                                $q3->where('name', 'like', "%$search%")
                                    ->orWhere('email', 'like', "%$search%");
                            });
                    });
            });
        }

        

        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }

        $quickRange = $request->input('quick_range', '90');
        if ($quickRange === '10s') {
            $from = now()->subSeconds(10);
            $query->where('created_at', '>=', $from);
        } elseif ($quickRange !== 'all') {
            $from = now()->subDays((int)$quickRange)->startOfDay();
            $query->where('created_at', '>=', $from);
        }

        $transactions = $query->latest()->paginate(10);

        // --- CONSULTA DE SOLICITUDES ---
        $requestsQuery = Transaction::where('type', 'request')
            ->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->with(['sender', 'receiver']);

        if ($request->filled('request_type')) {
            if ($request->request_type === 'send') {
                $requestsQuery->where('receiver_id', $user->id);
            } elseif ($request->request_type === 'receive') {
                $requestsQuery->where('sender_id', $user->id);
            }
        }

        if ($request->filled('request_status')) {
            $requestsQuery->where('status', $request->request_status);
        }

        if ($request->filled('request_search')) {
            $search = $request->request_search;
            $requestsQuery->where(function ($q) use ($search) {
                $q->whereHas('sender', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%")
                        ->orWhere('lastname', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                })->orWhereHas('receiver', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%")
                        ->orWhere('lastname', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            });
        }

        $requestQuickRange = $request->input('request_quick_range', '90');
        if ($requestQuickRange === '10s') {
            $from = now()->subSeconds(10);
            $requestsQuery->where('created_at', '>=', $from);
        } elseif ($requestQuickRange !== 'all') {
            $from = now()->subDays((int)$requestQuickRange)->startOfDay();
            $requestsQuery->where('created_at', '>=', $from);
        }

        $requests = $requestsQuery->latest()->paginate(10);

        return view('transactions.index', compact('transactions', 'requests'));
    }


    public function selectContact()
    {
        $userId = Auth::id();

        $contacts = DB::table('contacts')
            ->join('users', 'contacts.contact_id', '=', 'users.id')
            ->where('contacts.user_id', $userId)
            ->select(
                'contacts.id as contact_relation_id',
                'contacts.alias',
                'users.id as user_id',
                'users.name',
                'users.lastname',
                'users.email'
            )
            ->get();

        return view('transactions.contacts.select', compact('contacts'));
    }

    public function sendToContact($receiverId)
    {
        $receiver = User::findOrFail($receiverId);

        $wallet_balance = Auth::user()->wallet->balance ?? 0;
        $wallet_currency = 'S/.';

        return view('transactions.send.step2', [
            'receiver' => $receiver,
            'wallet_balance' => $wallet_balance,
            'wallet_currency' => $wallet_currency,
        ]);
    }


    public function downloadReceipt($id)
    {
        $transaction = Transaction::where('id', $id)
            ->where(function ($q) {
                $q->where('sender_id', Auth::id())
                    ->orWhere('receiver_id', Auth::id());
            })
            ->with(['sender', 'receiver'])
            ->firstOrFail();

        // Generar el PDF
        $pdf = Pdf::loadView('transactions.receipt', compact('transaction'));

        // Configurar el PDF
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        // Generar nombre del archivo
        $fileName = 'comprobante-' . $transaction->id . '-' . date('Y-m-d') . '.pdf';

        // Descargar el PDF
        return $pdf->download($fileName);
    }

    public function requestRefund(Request $request, $id)
    {
        $transaction = Transaction::where('id', $id)
            ->where('sender_id', Auth::id())
            ->where('status', 'completed')
            ->firstOrFail();


        return response()->json(['success' => true, 'message' => 'Solicitud de reembolso enviada']);
    }
}
