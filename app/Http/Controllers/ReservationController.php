<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReservationStatusNotification;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations;
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
       // Validate the request
    $validated = $request->validate([
        'event_id' => 'required|exists:events,id',
        'nombre_place' => 'required|integer|min:1',
    ]);

    // Find the event
    $event = Event::findOrFail($validated['event_id']);

    // Check if there are enough places available
    if ($event->nombre_place < $validated['nombre_place']) {
        return response()->json(['message' => 'Il n\'y a pas assez de places disponibles.'], 400);
    }

    // Create a new reservation
    $reservation = new Reservation();
    $reservation->user_id = Auth::id();
    $reservation->event_id = $event->id;
    $reservation->status = 'pending';
    $reservation->save();
    dd($reservation);
    // Decrease the number of available places
    $event->nombre_place -= $validated['nombre_place'];
    $event->save();

    // Notify the user
    Auth::user()->notify(new ReservationStatusNotification($reservation));

    // Notify the administrator
    $admin = User::where('is_admin', true)->first();
    if ($admin) {
        $admin->notify(new ReservationStatusNotification($reservation));
    }

    return response()->json(['message' => 'Réservation créée avec succès!']);
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return response()->json($reservation);
    }

    public function update(Request $request, $id)
    {

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->input('status');
        $reservation->save();

        // Notifier l'utilisateur du changement de statut
        $reservation->user->notify(new ReservationStatusNotification($reservation));

        return response()->json($reservation);
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return response()->json(null, 204);
    }
    public function cancel($id)
    {
        // Trouver la réservation par ID
        $reservation = Reservation::findOrFail($id);

        // Vérifier si l'utilisateur connecté est le propriétaire de la réservation
        if (Auth::id() !== $reservation->user_id) {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à annuler cette réservation.'], 403);
        }

        // Mettre à jour le statut de la réservation à 'cancelled'
        $reservation->status = 'cancelled';
        $reservation->save();

        // Notifier l'utilisateur de l'annulation
        Auth::user()->notify(new ReservationStatusNotification($reservation));

        // Notifier l'administrateur de l'annulation
        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            $admin->notify(new ReservationStatusNotification($reservation));
        }

        // Retourner une réponse avec succès
        return response()->json(['message' => 'Réservation annulée avec succès!']);
    }

    public function confirm(Request $request)
{
    $reservation = Reservation::findOrFail($request->reservation_id);

    if ($reservation->user_id != Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $reservation->status = 'pending'; // Initial status
    $reservation->save();

    // Notify admin
    $admin = User::where('is_admin', true)->first();
    if ($admin) {
        $admin->notify(new ReservationStatusNotification($reservation));
    }

    return response()->json(['message' => 'Reservation request sent to admin.']);
}

}
