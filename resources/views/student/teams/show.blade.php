{{-- resources/views/student/teams/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">{{ $team->name }}</h2>
    </x-slot>

    {{-- botão / formulário para nova submissão --}}
    <h3 class="text-lg font-semibold mb-2">Nova Submissão</h3>

    <form method="POST" action="{{ route('submissions.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="hidden" name="team_id" value="{{ $team->id }}">

        <input name="title" placeholder="Título" class="w-full border p-2">
        <textarea name="description" placeholder="Descrição" class="w-full border p-2"></textarea>

        <input type="file" name="file">

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Enviar</button>
    </form>

    {{-- lista de submissões existentes (opcional) --}}
    <h3 class="text-lg font-semibold mt-8 mb-2">Submissões</h3>
    @forelse ($team->submissions as $submission)
        <div class="p-4 bg-white shadow rounded mb-3">
            <a href="{{ route('submissions.show', $submission) }}" class="font-semibold">
                {{ $submission->title }}
            </a>
        </div>
    @empty
        <p>Nenhuma submissão ainda.</p>
    @endforelse
</x-app-layout>
