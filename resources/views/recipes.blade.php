<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Recipes') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-8">
                @foreach($recipes as $recipe)
                    <x-recipe-card :recipe="$recipe"></x-recipe-card>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
