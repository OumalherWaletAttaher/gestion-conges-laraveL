<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes demandes de congés
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('demande-conges.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded">
                    + Nouvelle demande
                </a>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-2">Type</th>
                            <th class="text-left p-2">Début</th>
                            <th class="text-left p-2">Fin</th>
                            <th class="text-left p-2">Statut</th>
                            <th class="text-left p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($demandeConges as $demande)
                            <tr class="border-b">
                                <td class="p-2">{{ $demande->typeConge->libelle }}</td>
                                <td class="p-2">{{ $demande->date_debut->format('d/m/Y') }}</td>
                                <td class="p-2">{{ $demande->date_fin->format('d/m/Y') }}</td>
                                <td class="p-2">{{ $demande->statut }}</td>
                                <td class="p-2">
                                    <a href="{{ route('demande-conges.edit', $demande) }}" class="text-blue-600">Modifier</a>
                                    <form action="{{ route('demande-conges.destroy', $demande) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-2 text-gray-500">Aucune demande pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>