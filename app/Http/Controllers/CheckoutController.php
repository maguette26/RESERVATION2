<?php
namespace App\Http\Controllers;

use Cart;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReservationDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index($id)
    {
        if (Auth::check()) {
            $panier = \Cart::getContent();
            $total = \Cart::getTotal();
            $event = Event::find($id); // Trouver l'événement par son ID

            if (!$event) {
                return redirect()->back()->withErrors(['message' => 'Événement non trouvé.']);
            }

            return view('frontend.checkout', compact('panier', 'total', 'event'));
        } else {
            return redirect()->route('login')->with('message', 'Veuillez vous connecter ou créer un compte pour accéder à la caisse.');
        }
    }


    public function process(Request $request)
    {
        Log::info('Process method called');

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $request->input('amount'),
                'currency' => 'mad',
                'description' => 'Paiement pour l\'événement',
                'source' => $request->input('stripeToken'),
                'receipt_email' => $request->input('email'),
            ]);

            Log::info('Charge successful', ['charge' => $charge]);

            return redirect()->route('confirmation')->with('success', 'Paiement réussi !');
        } catch (\Exception $e) {
            Log::error('Payment error: ' . $e->getMessage());

            return back()->withErrors(['message' => 'Erreur de paiement : ' . $e->getMessage()]);
        }
    }

    public function confirmation(Request $request)
    {
        $paniers = \Cart::getContent();

        // Créer une nouvelle réservation
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->status = 'confirmation';
        $reservation->total = \Cart::getTotal();
        $reservation->date_reservation = now();
        $reservation->save();

        // Enregistrez les détails de la réservation et décrémentez les places disponibles
        foreach ($paniers as $panier) {
            // Attacher l'événement à la réservation avec la quantité et le prix
            $reservation->events()->attach($panier->id, [
                'quantite' => $panier->quantity,
                'prix' => $panier->price,
            ]);

            // Décrémenter le nombre de places disponibles pour l'événement
            $event = Event::find($panier->id);
            if ($event) {
                // Vérifiez que le nombre de places réservées ne dépasse pas les places disponibles
                if ($event->nombre_place >= $panier->quantity) {
                    $event->nombre_place -= $panier->quantity;
                    $event->save();
                } else {
                    Log::error("Le nombre de places réservées dépasse les places disponibles pour l'événement : " . $event->name);
                }
            }
        }
        \Cart::clear();
  // Notifier l'admin via Node.js
  $response = Http::asJson()->post('http://localhost:3000/notify-admin', [
    'reservation_id' => $reservation->id,
    'user_id' => $reservation->user_id,
    'total' => $reservation->total,
    'date_reservation' => $reservation->date_reservation,
    'status' => $reservation->status,
]);
if ($response->failed()) {
    Log::error("Échec de la notification de l'admin via Node.js.");
}

if ($response->failed()) {
    Log::error("Échec de la notification de l'utilisateur via Node.js.");
}
        return view('confirmation');
    }

}
