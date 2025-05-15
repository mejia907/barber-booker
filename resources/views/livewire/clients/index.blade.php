<div>
    <!-- Spinner (se mantiene igual) -->
    <div wire:loading.flex
        class="fixed inset-0 flex bg-gray-100/70 dark:bg-gray-900/70 z-50 items-center justify-center">
        <svg class="animate-spin h-12 w-12 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Header con filtros - Agregamos filtro por estado -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Clients') }}</h1>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <!-- Barra de búsqueda -->
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="{{ __('Search Client') }}">
                </div>

                <!-- Filtro por estado -->
                <select wire:model.live="statusFilter"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm cursor-pointer px-1 mx-1.5">
                    <option value="active">Activos</option>
                    <option value="inactive">Inactivos</option>
                    <option value="all">Todos</option>
                </select>

                <!-- Botón Nuevo Cliente -->
                <a href="{{ route('clients.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="hidden sm:inline">{{ __('New Client') }}</span>
                </a>
            </div>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="rounded-xl border border-green-200 bg-green-50 p-4 text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de clientes -->
        <div
            class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                                Foto
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                                <div class="flex items-center gap-1 cursor-pointer" wire:click="sortBy('name')">
                                    {{ __('Name') }}
                                    @if ($sortField === 'name')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                                <div class="flex items-center gap-1 cursor-pointer" wire:click="sortBy('email')">
                                    {{ __('Email') }}
                                    @if ($sortField === 'email')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                                {{ __('Phone') }}
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                                {{ __('Status') }}
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-neutral-700 dark:bg-neutral-800">
                        @forelse ($clients as $client)
                            <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ $client->photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                            alt="{{ $client->name }}">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $client->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-neutral-400">
                                    {{ $client->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-neutral-400">
                                    {{ $client->phone ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span @class([
                                        'px-2 py-1 text-xs font-semibold rounded-full',
                                        'bg-green-100 text-green-800' => $client->status,
                                        'bg-red-100 text-red-800' => !$client->status,
                                    ])>
                                        {{ $client->status ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end items-center gap-3">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('clients.edit', $client->id) }}"
                                            class="p-1.5 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                            title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>

                                        <!-- Cambiar estado -->
                                        <button wire:click="changeStatus({{ $client->id }})" type="button"
                                            class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors focus:outline-none cursor-pointer"
                                            :class="{
                                                'bg-blue-600 dark:bg-blue-500': {{ $client->status ? 'true' : 'false' }},
                                                'bg-gray-300 dark:bg-gray-600': !
                                                    {{ $client->status ? 'true' : 'false' }}
                                            }"
                                            title="{{ $client->status ? 'Desactivar' : 'Activar' }}">
                                            <span
                                                class="inline-block h-3.5 w-3.5 transform rounded-full bg-white transition-all shadow-sm duration-200 ease-in-out"
                                                :class="{
                                                    'translate-x-4': {{ $client->status ? 'true' : 'false' }},
                                                    'translate-x-1': !{{ $client->status ? 'true' : 'false' }}
                                                }"></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-400">
                                    No se encontraron clientes
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($clients->hasPages())
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-3 dark:border-neutral-700 dark:bg-neutral-800">
                    {{ $clients->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
