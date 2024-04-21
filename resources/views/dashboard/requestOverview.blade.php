<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between h-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Overview requests') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 grid grid-cols-1 gap-4">
                        @foreach ($requests as $request)

                        <?php
                            $startDate = \Carbon\Carbon::parse($request['start_date']);
                            $endDate = \Carbon\Carbon::parse($request['end_date']);
                            $duration = $startDate->diffInDays($endDate);
                        ?>

                            <div class="p-6 w-1/1 bg-white shadow-lg rounded-lg overflow-hidden">

                                <div onclick="location.href='{{ route('requests.show', [$request['id']]) }}'">

                                    <h3 class='text-xl py-2'> {{ $request->user["name"] }} @if($request->user->isAdmin) (Admin) @endif </h3>
                                    <p>Can you sit my <b>{{ $request->pet['species'] }}</b> for <b>{{ $duration }}</b> days? </p>
                                    <p> $ {{$request['daily_rate']}} / day </p>
                                </div>

                                <div>
                                    <form method="POST" action="{{ route('userRequests.destroy', ['userRequest' => $request->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="userRequest" value="{{ $request }}">
                                        <x-primary-button class="mt-4">{{ __('Delete') }}</x-primary-button>
                                    </form>
                                </div>

                            </div>

                        @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
