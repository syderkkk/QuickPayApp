<?php

namespace App\Http\Controllers\User\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function read(Notification $notification)
    {
        $notification->is_active = false;
        $notification->save();

        return back()->with('success', 'Notificación marcada como leída.');
    }
}
