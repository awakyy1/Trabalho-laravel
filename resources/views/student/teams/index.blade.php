{{-- resources/views/student/teams/index.blade.php --}}
<x-app-layout>
    {{-- Título na barra superior do Breeze --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Minhas Equipes') }}
        </h2>
    </x-slot>

    {{-- Conteúdo principal --}}
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- botão criar equipe --}}
            <div class="mb-4">
                <a href="{{ route('teams.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent
                          rounded-md font-semibold text-xs text-white uppercase tracking-widest
                          hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2
                          focus:ring-indigo-500 transition ease-in-out duration-150">
                    + Criar equipe
                </a>
            </div>

            {{-- lista de equipes --}}
            @if ($teams->isEmpty())
                <p class="text-gray-600">Nenhuma equipe ainda.</p>
            @else
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($teams as $team)
                        <a href="{{ route('teams.show', $team) }}"
                           class="block p-5 bg-white shadow rounded hover:shadow-md transition">
                            <h3 class="text-lg font-semibold mb-1">{{ $team->name }}</h3>
                            <p class="text-sm text-gray-500">
                                Criada em {{ $team->created_at->format('d/m/Y') }}
                            </p>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
