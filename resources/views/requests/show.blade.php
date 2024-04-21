<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$pet['name']}} needs a home for {{$duration}} days
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w-2xl mx-auto">

                <div class="grid grid-cols-1 gap-4 overflow-visible sm:rounded-lg">

                    <section class="p-6 w-1/1 bg-white shadow-lg rounded-lg overflow-hidden">
                        <h3 class='text-xl py-2'> General info </h3>

                        <br>
                        <p>From: {{$request['start_date']}} </p>
                        <p>To: {{$request['end_date']}} </p>
                        <br>
                        <p>$ {{$request['daily_rate']}} / day <b>(total: $ {{$duration * $request['daily_rate'] }}) </b></p>
                        <br>
                        <p>{{$request['description']}}</p>
                    </section>

                    <section class="p-6 w-1/1 bg-white shadow-lg rounded-lg overflow-hidden">
                        <h3 class='text-xl py-2'> Meet {{$pet['name']}} the {{$pet['species']}} </h3>

                        <br>
                        @if($pet['profilepic'])
                            <img class="rounded-lg" src="{{ URL::asset('storage/images/'.$pet['profilepic']) }}" alt="{{ $pet['name'] }}">
                        @else
                            <p> No photo available</p>
                        @endif
                        <br>
                        <h4 class='text-lg py-2'> Breed </h4>
                        @if($pet['breed'])
                            <p> {{$pet['breed']}} </p>
                        @else
                            <p> Unknown </p>
                        @endif
                        <br>
                        <h4 class='text-lg py-2'> Behaviour </h4>
                        <p> {{$pet['behaviour']}} </p>
                        <br>
                        <h4 class='text-lg py-2'> Allergies </h4>
                        @if($pet['allergy'])
                            <p> {{$pet['allergy']}} </p>
                        @else
                            <p> No known allergies </p>
                        @endif
                    </section>

                    <section class="p-6 w-1/1 bg-white shadow-lg rounded-lg overflow-hidden">
                        <h3 class='text-xl py-2'> About the owner </h3>

                        <p> {{$owner['name']}} </p>
                        <br>
                        <h4 class='text-lg py-2'> Bio </h4>
                        <p> {{$owner['bio']}} </p>
                        <br>
                        <h4 class='text-lg py-2'> Location </h4>
                        <p> {{$owner['city']}}, {{$owner['country']}} </p>
                        <br>
                        <h4 class='text-lg py-2'> About my home </h4>
                        <p> {{$owner['home_info']}} </p>
                    </section>

                    <div>
                    <x-secondary-button
                        onclick="history.back()"
                        class="my-2">
                        {{ __('Go back') }}
                    </x-secondary-button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
