<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        if ($user && $user->role == 'admin') {
        $events = Event::all();
        return view('admin.events.index', compact('events'));

        }

        return redirect('/'); // Redirection si l'utilisateur n'est pas admin
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { $user = Auth::user();
        if ($user && $user->role == 'admin') {
            $eventTypes = EventType::all();
            return view('admin.events.create', ['eventTypes' => $eventTypes]);
    }

    return redirect('/');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'lieu' => 'required|string',
        'image' => 'required|image|max:1024',
        'nombre_place' => 'required|integer|max:50000',
        'description' => 'required|string',
        'date' => 'required|date',
        'prix' => 'required|integer|max:50000',
        'event_type_id' => 'required|integer',
        'heure' => 'required|date_format:H:i',
    ]);

    $event = new Event();
    $event->fill($validated);
$dossier="newimages";
    if ($request->hasFile('image')) {
        // $file = $request->file('image');
        // $path = $file->move('images', 'public');
        $nom_image=sha1(time()).".".$request->image->extension();
        $request->image->move(public_path($dossier),$nom_image);
        $event->image = $dossier."/".$nom_image;
    }

    $event->save();

    return redirect()->route('admin.index')->with('success', 'Événement ajouté avec succès');
}

public function edit($id)
{
    $user = Auth::user();
        if ($user && $user->role == 'admin') {
    $event = Event::findOrFail($id);
    $eventTypes = EventType::all();
    return view('admin.events.edit', compact('event', 'eventTypes'));
}
return redirect('/');
}
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lieu' => 'required|string',
            'image' => 'nullable|image|max:1024',
            'nombre_place' => 'required|integer|max:50000',
            'description' => 'required|string',
            'date' => 'required|date',
            'prix' => 'required|integer|max:50000',
            'event_type_id' => 'required|integer',
            'heure' => 'required|date_format:H:i',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }

            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $validated['image'] = $path;
        }
        $event->update($validated);

        return redirect()->route('admin.index', $event->id)->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::delete('public/' . $event->image);
        }

        $event->delete();
        return redirect()->route('admin.index');
    }

    public function showUsers()
    {
                     $users = User::all();
                          //   dd($users);
        return view('admin.utilisateurs', compact('users'));
    }


    public function showReservations()
{
    $reservations = Reservation::with(['user', 'events'])->get();
    return view('admin.reservations', compact('reservations'));
}

public function updateReservationStatus(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->status = $request->status;
    $reservation->save();

    // Envoyer une notification via HTTP
    try {
        $response = Http::post('http://localhost:3000/api/notifications', [
            'reservationId' => $reservation->id,
            'status' => $reservation->status,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.reservations')->with('status', 'Reservation status updated successfully');
        } else {
            return redirect()->route('admin.reservations')->with('error', 'Failed to send notification');
        }
    } catch (\Exception $e) {
        return redirect()->route('admin.reservations')->with('error', 'Exception occurred: ' . $e->getMessage());
    }
}
}
