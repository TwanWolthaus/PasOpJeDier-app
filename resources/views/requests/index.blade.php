

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between h-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pets In Need Of A Home') }}
            </h2>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black-500 bg-white hover:text-black-700 focus:outline-none transition ease-in-out duration-150">
                        <div>Sort By</div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('requests.sort', ['category'=>'rate'])">
                        {{ __('Daily Rate') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('requests.sort', ['category'=>'durationAsc'])">
                        {{ __('Shortest Duration') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('requests.sort', ['category'=>'durationDesc'])">
                        {{ __('Longest Duration') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('requests.sort', ['category'=>'species'])">
                        {{ __('Species') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('requests.sort', ['category'=>'fromUser'])">
                        {{ __('My requests only') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w-2xl mx-auto">

                <div class="grid grid-cols-1 gap-4 overflow-hidden sm:rounded-lg">

                    @foreach ($requests as $request)
                    <?php
                        $startDate = \Carbon\Carbon::parse($request['start_date']);
                        $endDate = \Carbon\Carbon::parse($request['end_date']);
                        $duration = $startDate->diffInDays($endDate);
                    ?>

                        <div class="p-6 w-1/1 bg-white shadow-lg rounded-lg overflow-hidden">

                            {{-- main info --}}
                            <div class="flex justify-between">

                                <div>
                                    <h3 class='text-xl py-2'> {{ $request->user["name"] }} </h3>
                                    <p>Can you sit my <b>{{ $request->pet['species'] }}</b> for <b>{{ $duration }}</b> days? </p>
                                    <p> $ {{$request['daily_rate']}} / day </p>
                                </div>

                                <div class="flex items-center">
                                <x-secondary-button
                                    onclick="location.href='{{ route('requests.show', [$request['id']]) }}'"
                                    class="m-2">
                                    {{ __('More info') }}
                                </x-secondary-button>
                                </div>

                            </div>

                            {{-- display comment --}}
                            <div class="pt-6 grid grid-cols-1 gap-4">
                                @foreach ($comments->where('request_id', $request['id']) as $comment)

                                <div class="flex justify-between p-4 bg-white shadow-lg rounded-lg border-t-2 border-indigo-500" >

                                    <div style="max-width: 60%;">
                                        <h4 class='text-l py-2'> <b> {{ $comment->user["name"] }} </b> </h4>
                                        <p style="word-wrap: break-word; ">
                                            {{$comment['text']}}
                                        </p>
                                    </div>

                                    @if (Auth::user() && $request['owner_id'] === $authUser['id'] && $comment['user_id'] != $authUser['id'])
                                        <div>
                                            <form method="POST" action="{{ route('transactions.store') }}">
                                                @csrf
                                                <input type="hidden" name="request_id" value={{$request['id']}}>
                                                <input type="hidden" name="sitter_id" value={{$comment['user_id']}}>

                                                <x-secondary-button class="mt-4" type="submit">{{ __('Accept') }}</x-secondary-button>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                                @endforeach
                            </div>

                            {{-- post comment --}}
                            <form method="POST" action="{{ route('comments.store', [$request['id']]) }}">
                                @csrf

                                @if (Auth::user())

                                    <input type="hidden" name="request_id" value={{$request['id']}}>
                                    <input type="hidden" name="user_id" value={{ Auth::user()['id'] }}>

                                    <div class="mt-4">
                                        <label for="text" class="block">
                                            {{ __('Response') }}
                                        </label>
                                        <textarea
                                            name="text"
                                            placeholder="{{ __('Leave your response.') }}"
                                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                            ></textarea>
                                    </div>

                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                    <x-primary-button class="mt-4">{{ __('Respond') }}</x-primary-button>

                                @endif
                            </form>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
