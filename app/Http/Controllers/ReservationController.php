<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Barryvdh\DomPDF\PDF;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


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
    $reservation = new Reservation();
    $reservation->user_id = Auth::id();
    $reservation->event_id = $event->id;
    $reservation->date_reservation = now();
    $reservation->quantite = $validated['nombre_place'];
    $reservation->prix = $event->prix * $validated['nombre_place'];
    $reservation->status = 'pending';
    $reservation->save();
    $event->save();
    return redirect()->route('reservations.show', $reservation->id);
}

protected $pdf;
    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }
public function download($id)
{
    $reservation = Reservation::with('events')->findOrFail($id);
    $pdf = $this->pdf->loadView('reservations.ticket', compact('reservation'));
    return $pdf->download('ticket.pdf');
}


public function show($id)
{
    $reservation = Reservation::with('events')->findOrFail($id);
    return view('reservations.show', compact('reservation'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|in:pending,confirmed,cancelled',
    ]);

    $reservation = Reservation::findOrFail($id);
    $oldStatus = $reservation->status;
    $reservation->status = $request->input('status');
    $reservation->save();
    return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
}
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }

    public function confirm(Request $request)
    {
        $reservation = Reservation::findOrFail($request->input('reservation_id'));

        if ($reservation->user_id != Auth::id()) {
            return redirect()->route('reservations.index')->withErrors(['message' => 'Non autorisé']);
        }

        $reservation->status = 'confirmed';
        $reservation->save();
        return redirect()->route('reservations.index')->with('success', 'Réservation confirmée avec succès.');
    }

}
