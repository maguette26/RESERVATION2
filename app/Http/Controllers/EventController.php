<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
       public function index()
        {
            $events = Event::all();
            return view('admin.index', compact('events'));
        }



    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('frontend.event-detail', compact('event'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Recherche des événements selon le nom ou la description
        $event = Event::where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->get();

        return view('frontend.recherche', compact('event'));
    }
}
