<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Barryvdh\DomPDF\PDF;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
            return back()->withErrors(['message' => 'Pas assez de places disponibles.']);
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

        // Générer le code QR et l'enregistrer dans un fichier
        $qrCodePath = public_path('qrcodes/' . $reservation->id . '.png');
        QrCode::format('png')->size(300)->generate($reservation->id, $qrCodePath);

        // Créer le contenu du ticket (optionnel : générer un PDF)
        $pdf = PDF::loadView('reservations.ticket', compact('reservation', 'qrCodePath'));

        // Envoyer l'e-mail avec le ticket
        Mail::send('emails.ticket', ['reservation' => $reservation], function ($message) use ($reservation, $pdf) {
            $message->to(Auth::user()->email)
                    ->subject('Votre Ticket de Réservation')
                    ->attachData($pdf->output(), 'ticket.pdf');
        });

        // Notifier l'admin
        Http::post('http://localhost:3000/notify-admin', [
            'reservation' => $reservation
        ]);

        return redirect()->route('reservations.index')->with('message', 'Réservation effectuée avec succès ! Un ticket a été envoyé à votre e-mail.');
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
    $oldStatus = $reservation->status;
    $reservation->status = $request->input('status');
    $reservation->save();
    if ($oldStatus !== $reservation->status) {
        $user = $reservation->user;
        Http::post('http://localhost:3000/notify-user', [
            'reservation' => $reservation,
            'user' => $user
        ]);
    }

    return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
}
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }

    // public function cancel($id)
    // {
    //     $reservation = Reservation::findOrFail($id);

    //     if (Auth::id() !== $reservation->user_id) {
    //         abort(403, 'Unauthorized action.');
    //     }
    //     foreach ($reservation->events as $event) {
    //         $event->nombre_place += $reservation->quantite;
    //         $event->save();
    //     }
    //     $reservation->delete();

    //     return redirect()->route('reservations.index')->with('message', 'Réservation annulée avec succès !');
    // }

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
