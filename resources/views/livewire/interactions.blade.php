<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Interacciones') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div id="admin-users-list">

            @if(session()->has('message'))
            <div class="mb-6 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3"
                 role="alert"
                 x-data="{show: true}"
                 x-init="setTimeout(() => show = false, 5000)"
                 x-show="show">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-8 w-8">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                </svg>
                <p class="px-2">{{ session('message') }}</p>
            </div>
            @endif

            <div class="block mb-0">
                <div class="relative grid grid-cols-2 gap-2 md:grid md:grid-cols-2 md:gap-6">
                    <div class=" mb-4">
                        <x-label for="date" value="Inicio" />
                        <x-datetime-picker id="start" name="start" class="mt-1 block w-full" wire:model="start" />
                        <x-input-error for="start" class="mt-2" />
                    </div>
                    <div class=" mb-4">
                        <x-label for="date" value="Fin" />
                        <x-datetime-picker id="end" name="end" class="mt-1 block w-full" wire:model="end" />
                        <x-input-error for="end" class="mt-2" />
                    </div>
                </div>
                <x-button class="mb-6" wire:click="search()" wire:loading.attr="disabled">
                    Buscar
                </x-button>

                <x-button class="mb-6" wire:click="generateCsv()" wire:loading.attr="disabled">
                    Generar CSV
                </x-button>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-gray-100">
                    <thead class="text-xs text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Correo electrónico
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edad
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Interacción
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users != null && $users->count() > 0)
                    @foreach($users as $user)
                    <tr class="bg-white border-b  dark:text-gray-500 font-medium">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$user->name}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$user->email}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$user->age}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$user->interaction_date}}
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-center" colspan="8">
                            No existe ninguna interacción
                        </th>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




