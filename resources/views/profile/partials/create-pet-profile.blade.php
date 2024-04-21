<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add pet') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create a new profile for one of your pets, so you can ask people to adopt her.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('pets.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="upload_pet_name" :value="__('Name')" />
            <x-text-input id="upload_pet_name" name="name" type="text" class="mt-1 block w-full"/>
        </div>

        <div>
            <x-input-label for="upload_pet_species" :value="__('Species')" />
            <x-text-input id="upload_pet_species" name="species" type="text" class="mt-1 block w-full"/>
        </div>

        <div>
            <x-input-label for="upload_pet_breed" :value="__('Breed')" />
            <x-text-input id="upload_pet_breed" name="breed" type="text" class="mt-1 block w-full"/>
        </div>

        <div>
            <x-input-label for="upload_pet_behaviour" :value="__('Behaviour')" />
            <x-text-input id="upload_pet_behaviour" name="behaviour" type="text" class="mt-1 block w-full"/>
        </div>

        <div>
            <x-input-label for="upload_pet_allergies" :value="__('Allergies')" />
            <x-text-input id="upload_pet_allergies" name="allergy" type="text" class="mt-1 block w-full"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add to your pets') }}</x-primary-button>
        </div>
    </form>

</section>
