<?php
namespace App\Http\Controllers\backend;

use App\Models\EventType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ind()
    {
        $user = Auth::user();
        if ($user && $user->role == 'admin') {
            $eventTypes = EventType::all();
            return view('admin.eventType.index', compact('eventTypes'));
        }

        return redirect('/'); // Redirection si l'utilisateur n'est pas admin
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user && $user->role == 'admin') {
            return view('admin.eventType.create');
        }

        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->role == 'admin') {
            $request->validate([
                'categorie' => 'required|string|max:255',

            ]);

            EventType::create([
                'categorie' => $request->categorie,

            ]);

            return redirect()->route('admin.eventTypes.index')->with('success', 'Type d\'événement créé avec succès.');
        }

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user && $user->role == 'admin') {
            $eventType = EventType::findOrFail($id);
            return view('admin.eventType.edit', compact('eventType'));
        }

        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user && $user->role == 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',

            ]);

            $eventType = EventType::findOrFail($id);
            $eventType->update([
                'categorie' => $request->categorie,

            ]);

            return redirect()->route('admin.eventTypes.index')->with('success', 'Type d\'événement mis à jour avec succès.');
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user && $user->role == 'admin') {
            $eventType = EventType::findOrFail($id);
            $eventType->delete();

            return redirect()->route('admin.eventTypes.index')->with('success', 'Type d\'événement supprimé avec succès.');
        }

        return redirect('/');
    }
}
