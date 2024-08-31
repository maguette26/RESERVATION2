<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Auth::user()->reservations()->with('events')->get();
        return view('reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'nombre_place' => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($validated['event_id']);

        if ($event->nombre_place < $validated['nombre_place']) {
            return back()->withErrors(['message' => 'Il n\'y a pas assez de places disponibles.']);
        }

        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->event_id = $event->id;
        $reservation->date_reservation = now();
        $reservation->quantite = $validated['nombre_place'];
        $reservation->prix = $event->prix * $validated['nombre_place'];
        $reservation->status = 'pending';
        $reservation->save();

        $event->nombre_place -= $validated['nombre_place'];
        $event->save();

        // Enlève les notifications
        // Auth::user()->notify(new ReservationStatusNotification($reservation));
        // $admin = User::where('admin', true)->first();
        // if ($admin) {
        //     $admin->notify(new ReservationStatusNotification($reservation));
        // }

        return redirect()->route('reservations.index')->with('message', 'Réservation créée avec succès!');
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,confirmed,cancelled',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->input('status');
        $reservation->save();

        // Enlève les notifications
        // $reservation->user->notify(new ReservationStatusNotification($reservation));

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (Auth::id() !== $reservation->user_id) {
            return redirect()->route('reservations.index')->withErrors(['message' => 'Vous n\'êtes pas autorisé à annuler cette réservation.']);
        }
        $reservation->status = 'cancelled';
        $reservation->save();

        // Enlève les notifications
        // $reservation->user->notify(new ReservationStatusNotification($reservation));
        // $admin = User::where('admin', true)->first();
        // if ($admin) {
        //     $admin->notify(new ReservationStatusNotification($reservation));
        // }

        return redirect()->route('reservations.index')->with('success', 'Réservation annulée avec succès.');
    }

    public function confirm(Request $request)
    {
        $reservation = Reservation::findOrFail($request->input('reservation_id'));

        if ($reservation->user_id != Auth::id()) {
            return redirect()->route('reservations.index')->withErrors(['message' => 'Non autorisé']);
        }

        $reservation->status = 'confirmed';
        $reservation->save();

        // Enlève les notifications
        // $admin = User::where('admin', true)->first();
        // if ($admin) {
        //     $admin->notify(new ReservationStatusNotification($reservation));
        // }

        return redirect()->route('reservations.index')->with('success', 'Réservation confirmée avec succès.');
    }
}
