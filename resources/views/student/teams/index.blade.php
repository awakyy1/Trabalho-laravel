<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">My teams</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('teams.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded text-white">
                    Create team
                </a>
            </div>

            @forelse ($teams as $team)
                <a href="{{ route('teams.show', $team) }}" class="block p-5 mb-4 bg-white shadow rounded">
                    <h3 class="text-lg font-semibold">{{ $team->name }}</h3>
                    <p class="text-sm text-gray-500">Created {{ $team->created_at->format('Y-m-d') }}</p>
                </a>
            @empty
                <p class="text-gray-600">You do not belong to a team yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
