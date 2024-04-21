<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Requests
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w-2xl mx-auto">

                <div class="grid grid-cols-1 gap-4 overflow-hidden sm:rounded-lg">

                    {{-- Display all user requests --}}
                    @foreach ($requests as $userRequest)

                        <div class="p-6 w-1/1 bg-white shadow-lg rounded-lg flex justify-between">

                            <div>
                                <h3 class='text-xl py-2'> Request to sit {{ $userRequest->pet['name'] }} </h2>
                                <p>From: {{$userRequest['start_date']}} </p>
                                <p>To: {{$userRequest['end_date']}} </p>
                                <p>Offer: ${{$userRequest['daily_rate']}} </p>
                                <p>Description: {{$userRequest['description']}} </p>
                            </div>

                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>

                                {{-- Dropdown: edit & delete --}}
                                <x-slot name="content" class="dropdown-start">
                                    <x-dropdown-link :href="route('userRequests.edit', ['userRequest' => $userRequest])">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('userRequests.destroy', $userRequest) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('userRequests.destroy', $userRequest)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>

                        </div>

                    @endforeach

                    {{-- Add request --}}
                    <div class="p-6 w-1/1 bg-white shadow-lg rounded-lg overflow-hidden">
                        <h3 class='text-xl py-2'> Create a new request </h3>
                        <form method="POST" action="{{ route('userRequests.store') }}">
                            @csrf

                            <div class="mt-4">
                                <label for="pet_id" class="block">
                                    {{ __('Pet') }}
                                </label>
                                <select id="pet_id" name="pet_id" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    @if ($authUser->pet->isEmpty())
                                        <option value="disabled" selected>You have no pets on this website yet</option>
                                    @else
                                        <option value="disabled" selected>Select your pet</option>
                                        @foreach ($authUser->pet as $pet)
                                            <option value="{{$pet->id}}">{{ $pet->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <x-input-error :messages="$errors->get('pet_id')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <label for="start_date" class="block">
                                    {{ __('Start Date') }}
                                </label>
                                <input type="date" id="start_date" name="start_date" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <label for="end_date" class="block">
                                    {{ __('End Date') }}
                                </label>
                                <input type="date" id="end_date" name="end_date" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <label for="daily_rate" class="block">
                                    {{ __('Daily Rate') }}
                                </label>
                                <input type="number" id="daily_rate" name="daily_rate" step="0.01" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('daily_rate')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <label for="description" class="block">
                                    {{ __('Description') }}
                                </label>
                                <textarea
                                    name="description"
                                    placeholder="{{ __('Describe your request') }}"
                                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    ></textarea>
                            </div>

                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            <x-primary-button class="mt-4">{{ __('Add') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
