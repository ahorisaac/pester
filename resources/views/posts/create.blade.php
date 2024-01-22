<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg sm:w-1/2 mx-auto">
                <form method="POST" action="{{ route('posts.create') }}" class="p-4">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <h2 class="text-normal text-3xl">Create Post</h2>
                    </div>

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" />
                    </div>

                    <!-- Body -->
                    <div>
                        <x-input-label for="body" :value="__('Body')" />
                        <x-text-input id="body" class="block mt-1 w-full" type="text" name="body" />
                    </div>

                    <!-- Title -->
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Create') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
