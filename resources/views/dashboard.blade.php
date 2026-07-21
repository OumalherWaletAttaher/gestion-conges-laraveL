<x-app-layout>
    <x-slot name="header">
        <h4 class="fw-bold mb-0">Dashboard</h4>
    </x-slot>

    @php
        $isManager = auth()->user()->role === 'manager';
        $mesDemandes = \App\Models\DemandeConge::where('user_id', auth()->id())->count();
        $enAttente = ($isManager ? \App\Models\DemandeConge::query() : \App\Models\DemandeConge::where('user_id', auth()->id()))
            ->where('statut', \App\Enums\StatutConge::EnAttente->value)->count();
        $validees = ($isManager ? \App\Models\DemandeConge::query() : \App\Models\DemandeConge::where('user_id', auth()->id()))
            ->where('statut', \App\Enums\StatutConge::Valide->value)->count();
        $refusees = ($isManager ? \App\Models\DemandeConge::query() : \App\Models\DemandeConge::where('user_id', auth()->id()))
            ->where('statut', \App\Enums\StatutConge::Refuse->value)->count();
        $recentes = ($isManager ? \App\Models\DemandeConge::with(['user', 'typeConge'])->latest() : \App\Models\DemandeConge::with('typeConge')->where('user_id', auth()->id())->latest())
            ->take(6)->get();
    @endphp

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background-color: #7b2f5f;">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $isManager ? \App\Models\DemandeConge::count() : $mesDemandes }}</div>
                    <div class="text-muted small">{{ $isManager ? 'Toutes les demandes' : 'Mes demandes' }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background-color: #d9a441;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $enAttente }}</div>
                    <div class="text-muted small">En attente</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background-color: #2f9e6f;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $validees }}</div>
                    <div class="text-muted small">Validées</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background-color: #c94f6d;">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $refusees }}</div>
                    <div class="text-muted small">Refusées</div>
                </div>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">{{ $isManager ? 'Demandes récentes de l\'équipe' : 'Mes demandes récentes' }}</h5>
            <a href="{{ route('demande-conges.index') }}" class="btn btn-brand btn-sm">Voir tout</a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small">
                        @if ($isManager)
                            <th>Employé</th>
                        @endif
                        <th>Type</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentes as $demande)
                        <tr>
                            @if ($isManager)
                                <td>{{ $demande->user->name }}</td>
                            @endif
                            <td>{{ $demande->typeConge->libelle }}</td>
                            <td>{{ $demande->date_debut->format('d/m/Y') }}</td>
                            <td>{{ $demande->date_fin->format('d/m/Y') }}</td>
                            <td>
                                @if ($demande->statut->value === 'valide')
                                    <span class="badge badge-valide">Validé</span>
                                @elseif ($demande->statut->value === 'refuse')
                                    <span class="badge badge-refuse">Refusé</span>
                                @else
                                    <span class="badge badge-attente">En attente</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $isManager ? 5 : 4 }}" class="text-center text-muted py-3">Aucune demande pour le moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>