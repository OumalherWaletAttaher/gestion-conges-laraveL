<?php

namespace App\Http\Controllers;

use App\Enums\StatutConge;
use App\Http\Requests\StoreDemandeCongeRequest;
use App\Http\Requests\UpdateDemandeCongeRequest;
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
            ->paginate(10);

        return view('demande-conges.index', compact('demandeConges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role === 'manager') {
            abort(403, 'Un manager ne peut pas déposer de demande de congé.');
        }

        $typeConges = TypeConge::all();

        return view('demande-conges.create', compact('typeConges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDemandeCongeRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['statut']  = StatutConge::EnAttente;

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
            abort(403, 'Vous ne pouvez consulter que vos propres demandes.');
        }

        return view('demande-conges.show', compact('demandeConge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandeConge $demandeConge)
    {
        if (auth()->id() !== $demandeConge->user_id) {
            abort(403, 'Vous ne pouvez modifier que vos propres demandes.');
        }

        // Bug #1 corrigé : protection côté serveur sur le statut
        if ($demandeConge->statut !== StatutConge::EnAttente) {
            abort(403, 'Seules les demandes en attente peuvent être modifiées.');
        }

        $typeConges = TypeConge::all();

        return view('demande-conges.edit', compact('demandeConge', 'typeConges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandeCongeRequest $request, DemandeConge $demandeConge)
    {
        if (auth()->id() !== $demandeConge->user_id) {
            abort(403, 'Vous ne pouvez modifier que vos propres demandes.');
        }

        // Bug #1 corrigé : protection côté serveur sur le statut
        if ($demandeConge->statut !== StatutConge::EnAttente) {
            abort(403, 'Seules les demandes en attente peuvent être modifiées.');
        }

        $validated = $request->validated();

        // Bug #2 corrigé : on remet le statut à en_attente après modification
        $validated['statut'] = StatutConge::EnAttente;

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
            abort(403, 'Vous ne pouvez supprimer que vos propres demandes.');
        }

        // Bug #1 corrigé : protection côté serveur sur le statut
        if ($demandeConge->statut !== StatutConge::EnAttente) {
            abort(403, 'Seules les demandes en attente peuvent être supprimées.');
        }

        $demandeConge->delete();

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'La demande de congé a bien été supprimée.');
    }

    /**
     * Valider une demande (manager uniquement).
     */
    public function valider(DemandeConge $demandeConge)
    {
        $demandeConge->update(['statut' => StatutConge::Valide]);

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'La demande a été validée.');
    }

    /**
     * Refuser une demande (manager uniquement).
     */
    public function refuser(DemandeConge $demandeConge)
    {
        $demandeConge->update(['statut' => StatutConge::Refuse]);

        return redirect()
            ->route('demande-conges.index')
            ->with('success', 'La demande a été refusée.');
    }
}
