<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeConge;
use App\Models\TypeConge;

class DemandeCongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demandeConges = DemandeConge::with(['user', 'typeConge'])
            ->latest()
            ->get();

        return view('demande-conges.index', compact('demandeConges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeConges = TypeConge::all();

        return view('demande-conges.create', compact('typeConges'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_conge_id' => 'required|exists:type_conges,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['statut'] = 'en_attente';

        DemandeConge::create($validated);

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'Votre demande de congé a bien été envoyée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DemandeConge $demandeConge)
    {
        return view('demande-conges.show', compact('demandeConge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandeConge $demandeConge)
    {
        $typeConges = TypeConge::all();

        return view('demande-conges.edit', compact('demandeConge', 'typeConges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DemandeConge $demandeConge)
    {
        $validated = $request->validate([
            'type_conge_id' => 'required|exists:type_conges,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:1000',
        ]);

        $demandeConge->update($validated);

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'La demande de congé a bien été modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemandeConge $demandeConge)
    {
        $demandeConge->delete();

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'La demande de congé a bien été supprimée.');
    }
}
