<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">
            Mes demandes de congés
        </h2>
    </x-slot>

    <div class="container py-4">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">

                <a href="{{ route('demande-conges.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Nouvelle demande
                </a>

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Type</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($demandeConges as $demande)
                                <tr>
                                    <td>{{ $demande->typeConge->libelle }}</td>
                                    <td>{{ $demande->date_debut->format('d/m/Y') }}</td>
                                    <td>{{ $demande->date_fin->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($demande->statut === 'valide')
                                            <span class="badge bg-success">Validé</span>
                                        @elseif ($demande->statut === 'refuse')
                                            <span class="badge bg-danger">Refusé</span>
                                        @else
                                            <span class="badge bg-warning text-dark">En attente</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->id() === $demande->user_id && $demande->statut === 'en_attente')
                                            <a href="{{ route('demande-conges.edit', $demande) }}" class="btn btn-sm btn-outline-primary">
                                                Modifier
                                            </a>

                                            <button type="button" class="btn btn-sm btn-outline-danger" data-mdb-toggle="modal" data-mdb-target="#deleteModal{{ $demande->id }}">
                                                Supprimer
                                            </button>

                                            <!-- Modale de confirmation -->
                                            <div class="modal fade" id="deleteModal{{ $demande->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirmer la suppression</h5>
                                                            <button type="button" class="btn-close" data-mdb-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Es-tu sûr de vouloir supprimer cette demande de congé ? Cette action est irréversible.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Annuler</button>
                                                            <form action="{{ route('demande-conges.destroy', $demande) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (auth()->user()->role === 'manager' && $demande->statut === 'en_attente')
                                            <form action="{{ route('demande-conges.valider', $demande) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">Valider</button>
                                            </form>

                                            <form action="{{ route('demande-conges.refuser', $demande) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-warning">Refuser</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Aucune demande pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>