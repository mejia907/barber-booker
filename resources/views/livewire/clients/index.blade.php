<div>
    <!-- Spinner -->
    <div wire:loading.flex class="fixed inset-0 z-50 items-center justify-center bg-gray-100/70 dark:bg-gray-900/70">
        <svg class="animate-spin h-12 w-12 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.4 0 0 5.4 0 12h4zm2 5a8 8 0 01-2-5H0c0 3 1 5.8 3 8l3-3z" />
        </svg>
    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Header con filtros -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Clients') }}</h1>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <!-- Barra de búsqueda -->
                <x-shared.search-input wireModel="search" placeholder="{{ __('Search Client') }}" />

                <!-- Filtro por estado -->
                <select wire:model.live="statusFilter"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm cursor-pointer px-1 mx-1.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="active">Activos</option>
                    <option value="inactive">Inactivos</option>
                    <option value="all">Todos</option>
                </select>

                <!-- Botón Nuevo Cliente -->
                <x-shared.create-button href="{{ route('clients.create') }}" text="{{ __('New Client') }}" />
            </div>
        </div>

        <!-- Mensaje de éxito -->
        <x-shared.message-success />

        <!-- Mensaje de error -->
        <x-shared.message-error />

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
                                            class="p-1.5 text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300 rounded-full hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors"
                                            title="Editar">
                                            <x-lucide-pencil class="w-4 h-4" />
                                        </a>

                                        <!-- Cambiar estado -->
                                        <button wire:click="changeStatus({{ $client->id }})" type="button"
                                            class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors focus:outline-none cursor-pointer"
                                            :class="{
                                                'bg-amber-600 dark:bg-amber-500': {{ $client->status ? 'true' : 'false' }},
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
