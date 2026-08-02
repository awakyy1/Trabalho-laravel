<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold">{{ $team->name }}</h2></x-slot>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        @if ($team->description)<p class="mb-6 text-gray-700">{{ $team->description }}</p>@endif

        <h3 class="text-lg font-semibold mb-2">New submission</h3>
        <form method="POST" action="{{ route('submissions.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="team_id" value="{{ $team->id }}">
            <label class="block">Title
                <input name="title" maxlength="255" required value="{{ old('title') }}" class="w-full border p-2">
            </label>
            @error('title') <p class="text-red-600">{{ $message }}</p> @enderror
            <label class="block">Description
                <textarea name="description" maxlength="5000" class="w-full border p-2">{{ old('description') }}</textarea>
            </label>
            @error('description') <p class="text-red-600">{{ $message }}</p> @enderror
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Create submission</button>
        </form>

        <h3 class="text-lg font-semibold mt-8 mb-2">Submissions</h3>
        @forelse ($team->submissions as $submission)
            <a href="{{ route('submissions.show', $submission) }}" class="block p-4 bg-white shadow rounded mb-3">
                <span class="font-semibold">{{ $submission->title }}</span>
                <span class="text-sm text-gray-500">{{ ucfirst($submission->status) }}</span>
            </a>
        @empty
            <p>No submissions yet.</p>
        @endforelse
    </div>
</x-app-layout>
