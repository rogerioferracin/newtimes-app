<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl - text-gray-800 leading-tight">
            @if ($usuario)
                {{ __('Edita Usuário')}}  {{ $usuario->name }}
            @else
                {{ __('Novo Usuário')}}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                <!-- TEMPLATE -->
                @if ($usuario)
                    @include('usuarios.partials.edituser')
                @else
                    @include('usuarios.partials.newuser')
                @endif
                <!-- END TEMPLATE -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
