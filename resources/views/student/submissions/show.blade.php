<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold">{{ $submission->title }}</h2></x-slot>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <p><a href="{{ route('teams.show', $submission->team) }}">{{ $submission->team->name }}</a></p>
        @if ($submission->description)<p class="my-4">{{ $submission->description }}</p>@endif
        <p class="text-sm text-gray-500">Status: {{ ucfirst($submission->status) }}</p>

        <h3 class="text-lg font-semibold mt-8 mb-2">Versions</h3>
        @foreach ($submission->versions as $version)
            <section class="p-4 bg-white shadow rounded mb-4">
                <h4 class="font-semibold">Version {{ $version->version }}</h4>
                @if ($version->changelog)<p>{{ $version->changelog }}</p>@endif

                <div class="mt-4">
                    @forelse ($version->comments as $comment)
                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}</p>
                    @empty
                        <p class="text-gray-500">No comments for this version.</p>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('comments.store') }}" class="mt-4">
                    @csrf
                    <input type="hidden" name="submission_version_id" value="{{ $version->id }}">
                    <label class="block">Add a comment
                        <textarea name="body" maxlength="2000" required class="w-full border p-2"></textarea>
                    </label>
                    <button class="px-3 py-2 bg-indigo-600 text-white rounded">Post comment</button>
                </form>
            </section>
        @endforeach
    </div>
</x-app-layout>
