<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit your request
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w-2xl mx-auto">

                <div class="grid grid-cols-1 gap-4 overflow-hidden sm:rounded-lg">

                    <div class="p-6 w-1/1 bg-white shadow-lg rounded-lg overflow-hidden">

                    <form method="POST" action="{{ route('userRequests.update', $userRequest) }}">
                        @csrf
                        @method('patch')

                        <div class="mt-4">
                            <label for="description" class="block">
                                {{ __('Description') }}
                            </label>
                            <textarea
                                name="description"
                                placeholder="{{ __('Your new request') }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                >{{ old('message', $userRequest->description) }}</textarea>

                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <label for="start_date" class="block">
                                {{ __('Start Date') }}
                            </label>
                            <input type="date" id="start_date" name="start_date" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            value={{ old('date', $userRequest->start_date) }}>
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <label for="end_date" class="block">
                                {{ __('End Date') }}
                            </label>
                            <input type="date" id="end_date" name="end_date" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            value={{ old('date', $userRequest->end_date) }}>
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <label for="daily_rate" class="block">
                                {{ __('Daily Rate') }}
                            </label>
                            <input type="number" id="daily_rate" name="daily_rate" step="0.01" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            value={{ old('number', $userRequest->daily_rate) }}>
                            <x-input-error :messages="$errors->get('daily_rate')" class="mt-2" />
                        </div>

                        <div class="mt-4 space-x-2">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <a href="{{ route('userRequests.index') }}">{{ __('Cancel') }}</a>
                        </div>
                    </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
