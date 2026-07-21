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
        $isManager = auth()->user()->role === 'manager';

        $demandeConges = DemandeConge::with(['user', 'typeConge'])
            ->when(!$isManager, function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('demande-conges.index', compact('demandeConges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         if (auth()->user()->role === 'manager') {
            abort(403, "Un manager ne peut pas déposer de demande de congé.");
        }

        $typeConges = TypeConge::all();

        return view('demande-conges.create', compact('typeConges'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role === 'manager') {
            abort(403, "Un manager ne peut pas déposer de demande de congé.");
        }

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
    $isManager = auth()->user()->role === 'manager';

    if (!$isManager && auth()->id() !== $demandeConge->user_id) {
        abort(403, "Vous ne pouvez consulter que vos propres demandes.");
    }

    return view('demande-conges.show', compact('demandeConge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandeConge $demandeConge)
    {   
        if (auth()->id() !== $demandeConge->user_id) {
            abort(403,"Vous ne pouvez modifier que vos propres demandes.");
        }

        $typeConges = TypeConge::all();

        return view('demande-conges.edit', compact('demandeConge', 'typeConges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DemandeConge $demandeConge)
    {   
        if (auth()->id() !== $demandeConge->user_id) {
            abort(403,"Vous ne pouvez modifier que vos propres demandes.");
        }

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
        if (auth()->id() !== $demandeConge->user_id) {
            abort(403,"Vous ne pouvez modifier que vos propres demandes.");
        }

        $demandeConge->delete();

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'La demande de congé a bien été supprimée.');
    }

    public function valider(DemandeConge $demandeConge)
    {
        $demandeConge->update(['statut' => 'valide']);

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'La demande a été validée.');
    }

    public function refuser(DemandeConge $demandeConge)
    {
        $demandeConge->update(['statut' => 'refuse']);

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'La demande a été refusée.');
    }
}
