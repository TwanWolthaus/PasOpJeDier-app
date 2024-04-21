<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w-1xl mx-auto">

                <div class="grid grid-cols-1 gap-4 overflow-hidden sm:rounded-lg">

                    <div class="p-6 w-1/1 bg-white shadow-lg rounded-lg flex flex-col">

                        <div class="flex justify-center items-center p-0">
                            <x-primary-button
                                onclick="location.href='{{ route('dashboard.userOverview') }}'"
                                class="m-2">
                                {{ __('View all users') }}
                            </x-primary-button>
                        </div>

                        <div class="flex justify-center items-center p-0">
                            <x-primary-button
                                onclick="location.href='{{ route('dashboard.requestOverview') }}'"
                                class="m-2">
                                {{ __('View all requests') }}
                            </x-primary-button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
