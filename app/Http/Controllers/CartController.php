<?PHP
 Namespace App\Http\Controllers;

 use Darryldecode\Cart\Facades\CartFacade as Cart;
 use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index()
    {

        return view('cart.index' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'number_of_places' => 'required|integer|min:1'
        ]);

        $event = Event::find($request->event_id);

        try {
            // Ajouter l'événement au panier
            Cart::add([
                'id' => $event->id,
                'name' => $event->name,
                'quantity' => $request->number_of_places,
                'price' => $event->prix,
                'attributes' => [
                    'image' => $event->image,
                ],
            ]);

            return redirect()->back()->with('success', 'Événement ajouté au panier.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Update the quantity of an item in the cart.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');

        try {
            \Cart::update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $quantity
                ],
            ]);

            $total = \Cart::getTotal();

            return redirect()->back()->with('success', 'Quantité mise à jour avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove an item from the cart.
     */
    public function destroy($id)
    {
        try {
            \Cart::remove($id);

            $total = \Cart::getTotal();

            return redirect()->route('cart.index')->with([
                'success' => 'Article supprimé du panier.',
                'total' => $total
            ]);

        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the checkout page.
     */


    /**
     * Get a unique checkout ID.
     */
    public function getCheckoutId()
    {
        return session('order_id', uniqid());
    }
}
