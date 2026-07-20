<x-app-layout>
    <x-slot name="header">
        <h4 class="fw-bold mb-0">Modifier la demande de congé</h4>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="stat-card">

                <form method="POST" action="{{ route('demande-conges.update', $demandeConge) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="type_conge_id" class="form-label">Type de congé</label>
                        <select id="type_conge_id" name="type_conge_id" class="form-select @error('type_conge_id') is-invalid @enderror" required>
                            @foreach ($typeConges as $type)
                                <option value="{{ $type->id }}" {{ old('type_conge_id', $demandeConge->type_conge_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->libelle }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_conge_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" id="date_debut" name="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut', $demandeConge->date_debut->format('Y-m-d')) }}" required>
                            @error('date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="date" id="date_fin" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ old('date_fin', $demandeConge->date_fin->format('Y-m-d')) }}" required>
                            @error('date_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="motif" class="form-label">Motif</label>
                        <textarea id="motif" name="motif" rows="4" class="form-control @error('motif') is-invalid @enderror">{{ old('motif', $demandeConge->motif) }}</textarea>
                        @error('motif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-brand">
                            <i class="bi bi-check2 me-2"></i>Mettre à jour
                        </button>
                        <a href="{{ route('demande-conges.index') }}" class="btn btn-outline-secondary">
                            Annuler
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>