<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista Usuários') }}
        </h2>
    </x-slot>
    @role('admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <x-link href="{{ route('usuarios.create')}}" class="m-4">Novo Usuário</x-link>
                <table class="min-w-full text-center font-light">
                    <thead class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                        <tr>
                            <th scope="col" class="px-6 py-4">ID</th>
                            <th scope="col" class="px-6 py-4">Nome</th>
                            <th scope="col" class="px-6 py-4">Cel</th>
                            <th scope="col" class="px-6 py-4">Email</th>
                            <th scope="col" class="px-6 py-4">Função</th>
                            <th scope="col" class="px-6 py-4">-</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $usuario->id }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $usuario->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $usuario->cel }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $usuario->email }}</td>
                            <td class="whitespace-nowrap px-6 py-4 uppercase">{{ $usuario->getRole($usuario) }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <x-link  data-te-toggle="tooltip" title="Edita usuário" href="{{ route('usuarios.edit', $usuario)}}" class="btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fa-solid fa-pen"></i>
                                    <span class="sr-only">Icon description</span>
                                </x-link>
                                <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button
                                    data-te-toggle="tooltip" title="Exclui usuário"
                                    type="submit"
                                    onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i>
                                        <i class="sr-only">Delete</i>
                                    </x-danger-button>
                                </form>
                                <x-primary-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'change-password')"
                                        data-te-toggle="tooltip"
                                        title="Altera senha">
                                    <i class="fa-solid fa-key"></i>
                                    <i class="sr-only">Altera senha</i>
                                </x-primary-button>
                                {{-- ADD MODAL --}}
                                <x-modal name="change-password">
                                    @include('usuarios.partials.update-password')
                                </x-modal>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <h2>Voce não tem autorização</h2>
        @endrole
    </div>

</x-app-layout>
