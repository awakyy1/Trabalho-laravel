<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold">Create a team</h2></x-slot>

    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('teams.store') }}" class="space-y-4">
            @csrf
            <label class="block">Name
                <input name="name" maxlength="255" required value="{{ old('name') }}" class="w-full border p-2">
            </label>
            @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
            <label class="block">Description
                <textarea name="description" maxlength="2000" class="w-full border p-2">{{ old('description') }}</textarea>
            </label>
            @error('description') <p class="text-red-600">{{ $message }}</p> @enderror
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Create team</button>
        </form>
    </div>
</x-app-layout>
