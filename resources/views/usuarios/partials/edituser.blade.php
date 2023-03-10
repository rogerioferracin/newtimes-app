<form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Nome')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $usuario->name)" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $usuario->email)" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="cel" :value="__('Celular')" />
        <x-text-input id="cel" class="block mt-1 w-full" type="text" name="cel" :value="old('cel', $usuario->cel)" required autocomplete="cel" />
        <x-input-error :messages="$errors->get('cel')" class="mt-2" />
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Atualizar') }}
        </x-primary-button>
    </div>
</form>
