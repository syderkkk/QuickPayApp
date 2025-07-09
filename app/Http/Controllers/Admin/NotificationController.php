<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Notifaciones solamente de tipo System
        $query = Notification::with('user')
            ->where('type', 'system')
            ->latest();

        // Filtro por búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filtro por tipo
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $notifications = $query->paginate(10);
        $users = User::where('role', 'user')->get();

        return view('admin.notifications.index', compact('notifications', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'type' => 'required|in:system,payment,request,refund',
            'user_id' => 'nullable|exists:users,id',
            'send_to_all' => 'boolean'
        ]);

        if ($request->send_to_all) {
            // Enviar a todos los usuarios
            $users = User::where('role', 'user')->get();

            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'message' => $request->message,
                    'type' => $request->type,
                    'is_active' => true,
                ]);
            }

            return redirect()->route('admin.notifications.index')
                ->with('success', 'Notificación enviada a todos los usuarios exitosamente.');
        } else {
            // Enviar a usuario específico
            Notification::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'message' => $request->message,
                'type' => $request->type,
                'is_active' => true,
            ]);

            return redirect()->route('admin.notifications.index')
                ->with('success', 'Notificación creada exitosamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notification = Notification::with('user')->findOrFail($id);
        return view('admin.notifications.show', compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notificación eliminada exitosamente.');
    }

    /**
     * Update notification status
     */
    public function updateStatus($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->is_active = !$notification->is_active;
        $notification->save();

        $status = $notification->is_active ? 'activada' : 'desactivada';

        return redirect()->route('admin.notifications.index')
            ->with('success', "Notificación {$status} exitosamente.");
    }
}
