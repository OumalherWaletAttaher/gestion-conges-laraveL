<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nouvelle demande de congé
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('demande-conges.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Type de congé</label>
                        <select name="type_conge_id" class="w-full border rounded p-2">
                            <option value="">-- Choisir --</option>
                            @foreach ($typeConges as $type)
                                <option value="{{ $type->id }}" {{ old('type_conge_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->libelle }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_conge_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Date de début</label>
                        <input type="date" name="date_debut" value="{{ old('date_debut') }}" class="w-full border rounded p-2">
                        @error('date_debut')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Date de fin</label>
                        <input type="date" name="date_fin" value="{{ old('date_fin') }}" class="w-full border rounded p-2">
                        @error('date_fin')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Motif</label>
                        <textarea name="motif" rows="4" class="w-full border rounded p-2">{{ old('motif') }}</textarea>
                        @error('motif')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Envoyer la demande</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>