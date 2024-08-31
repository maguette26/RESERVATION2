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
            return redirect()->route('login')->with('message', 'Veuillez vous connecter pour accéder à la caisse.');
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

    public function confirmation()
    {
        $paniers = \Cart::getContent();
        $firstPanier = $paniers->first();

        // Créez une nouvelle réservation
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->event_id = $firstPanier->id;
        $reservation->status = 'confirmation';
        $reservation->total = \Cart::getTotal();
        $reservation->date_reservation = now();
        $reservation->save();

        // Enregistrez les détails de la réservation
        foreach ($paniers as $panier) {
            ReservationDetail::create([
                'reservation_id' => $reservation->id,
                'event_id' => $panier->id,
                'quantite' => $panier->quantity,
                'prix' => $panier->price,
            ]);
        }

        // Vider le panier après la confirmation
        \Cart::clear();

        return view('confirmation');
    }
}
