<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your transactions: Pets in your care
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w-2xl mx-auto">

                <div class="grid grid-cols-1 gap-4 overflow-hidden sm:rounded-lg">

                    @foreach ($transactions as $transaction)

                        <div class="p-6 w-1/1 bg-white shadow-lg rounded-lg">
                            <h3 class='text-xl py-2'> Request to sit {{ $transaction->request->pet['name'] }} </h3>
                            <p>From: {{$transaction->request['start_date']}} </p>
                            <p>To: {{$transaction->request['end_date']}} </p>
                            <p>Offer: ${{$transaction->request['daily_rate']}} </p>
                            <p>Description: {{$transaction->request['description']}} </p>
                            <br>

                            <h4 class='text-xl py-2'> Review from the owner ({{$transaction->request->user->name}}). </h4>
                            @if($transaction['review_owner'])
                                <p> {{$transaction['review_owner']}}   </p>
                            @else
                                <p> No review available </p>
                            @endif
                            <br>
                            <h4 class='text-xl py-2'> Review from the sitter ({{$transaction->sitter->name}}). </h4>
                            @if($transaction['review_sitter'])
                                <p> {{$transaction['review_sitter']}}   </p>
                            @else
                                <p> No review available </p>
                            @endif
                            <br>

                            <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                                @csrf
                                @method('patch')

                                <div class="mt-4">
                                    <label for="review" class="block">
                                        @if ($transaction['review_sitter'] == null)
                                            {{ __('Post your review') }}
                                        @else
                                            {{ __('Update your review') }}
                                        @endif
                                    </label>
                                    <textarea
                                        name="review_sitter"
                                        placeholder="{{ __('Your review') }}"
                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        ></textarea>

                                    <input type="hidden" name="review_owner" value={{ $transaction['review_owner'] }}>

                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                </div>
                                <x-secondary-button class="mt-4" type="submit">{{ __('Post') }}</x-secondary-button>
                            </form>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
