<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function notifyAdmin(Request $request)
    {
        $reservation = $request->input('reservation');
        $admin = User::where('role', 'admin')->first();

        if ($admin) {
            $response = Http::post('http://localhost:3000/notify-admin', [
                'reservation' => $reservation
            ]);

            return response();

            if ($response->successful()) {
                return response()->json(['message' => 'Notification sent to admin.']);
            } else {
                return response()->json(['message' => 'Failed to notify admin', 'error' => $response->body()], 500);
            }
        }

        return response()->json(['message' => 'Admin not found.'], 404);
    }

    public function notifyUser(Request $request)
    {
        $reservation = $request->input('reservation');
        $user = User::find($reservation['user_id']);

        if ($user) {
            $response = Http::post('http://localhost:3000/notify-user', [
                'reservation' => $reservation,
                'user' => $user
            ]);

            if ($response->successful()) {
                return response()->json(['message' => 'Notification sent to user.']);
            } else {
                return response()->json(['message' => 'Failed to notify user', 'error' => $response->body()], 500);
            }
        }

        return response()->json(['message' => 'User not found.'], 404);
    }
}
