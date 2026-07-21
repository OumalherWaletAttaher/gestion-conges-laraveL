<x-app-layout>
    <x-slot name="header">
        <h4 class="fw-bold mb-0">Détail de la demande</h4>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="stat-card">

                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $demandeConge->user->name }}</h5>
                        <div class="text-muted small">{{ $demandeConge->user->email }}</div>
                    </div>
                    @if ($demandeConge->statut->value === 'valide')
                        <span class="badge badge-valide fs-6">Validé</span>
                    @elseif ($demandeConge->statut->value === 'refuse')
                        <span class="badge badge-refuse fs-6">Refusé</span>
                    @else
                        <span class="badge badge-attente fs-6">En attente</span>
                    @endif
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small">Type de congé</div>
                        <div class="fw-semibold">{{ $demandeConge->typeConge->libelle }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Durée</div>
                        <div class="fw-semibold">
                            {{ $demandeConge->date_debut->diffInDays($demandeConge->date_fin) + 1 }} jour(s)
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small">Date de début</div>
                        <div class="fw-semibold">{{ $demandeConge->date_debut->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Date de fin</div>
                        <div class="fw-semibold">{{ $demandeConge->date_fin->format('d/m/Y') }}</div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="text-muted small">Motif</div>
                    <div class="fw-semibold">{{ $demandeConge->motif }}</div>
                </div>

                <hr>

                <div class="row text-muted small">
                    <div class="col-6">
                        <i class="bi bi-clock me-1"></i>
                        Demande envoyée le {{ $demandeConge->created_at->format('d/m/Y à H:i') }}
                    </div>
                    @if ($demandeConge->updated_at != $demandeConge->created_at)
                        <div class="col-6">
                            <i class="bi bi-pencil me-1"></i>
                            Modifiée le {{ $demandeConge->updated_at->format('d/m/Y à H:i') }}
                        </div>
                    @endif
                </div>

                <div class="mt-4">
                    <a href="{{ route('demande-conges.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>