<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between h-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Overview users') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 grid grid-cols-1 gap-4">
                        @foreach ($users as $user)

                            <?php
                                if ($user->status) {
                                    $action = "Block";
                                } else {
                                    $action = "Unblock";
                                }
                            ?>

                            <div class="p-6 w-1/1 bg-white shadow-lg rounded-lg overflow-hidden">

                                <p> {{$user['name']}} @if ($user['isAdmin']) (Admin) @endif </p>

                                <form method="POST" action="{{ route('dashboard.alterUserStatus') }}">
                                    @csrf
                                    <input type="hidden" name="userID" value="{{ $user->id }}">
                                    <x-primary-button class="mt-4">{{ __($action) }}</x-primary-button>
                                </form>

                            </div>

                        @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
