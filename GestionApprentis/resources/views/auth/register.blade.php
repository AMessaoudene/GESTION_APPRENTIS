@section('title', 'Créer un nouveau compte')
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Nom -->
        <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('Nom')" class="mt-2" />
        </div>

        <!-- Prenom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prenom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('Prenom')" class="mt-2" />
        </div>

        <!-- civilite -->
        <div class="mt-4">
            <x-input-label for="civilite" :value="__('Civilité')" />
            <select id="civilite" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="civilite">
                <option value="">-- Select --</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
            <x-input-error :messages="$errors->get('civilite')" class="mt-2" />
        </div>

        <!-- Structure -->
        <div class="mt-4">
            <x-input-label for="structures_id" :value="__('structure')" />
            <select id="structure" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="structures_id">
                <option value="">-- Select --</option>
                @foreach ($structures as $structure)
                    <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('structures_id')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="role">
                <option value="">-- Select --</option>
                <option value="DFP">DFP</option>
                <option value="DRH">DRH</option>
                <option value="SA">SA</option>
                <option value="EvaluateurGradé">Evaluateur Gradé</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
