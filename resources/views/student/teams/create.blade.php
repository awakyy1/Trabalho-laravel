<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nova Equipe</h2>
    </x-slot>

    <form method="POST" action="{{ route('teams.store') }}" class="space-y-4">
        @csrf
        <input name="name" class="w-full border p-2" placeholder="Nome da equipe">
        @error('name') <div class="text-red-600">{{ $message }}</div> @enderror
        <button class="btn btn-primary">Salvar</button>
    </form>
</x-app-layout>
