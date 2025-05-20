<div>
    <!-- Spinner de carga -->
    <div wire:loading.flex class="fixed inset-0 z-50 items-center justify-center bg-gray-100/70 dark:bg-gray-900/70">
        <svg class="animate-spin h-12 w-12 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.4 0 0 5.4 0 12h4zm2 5a8 8 0 01-2-5H0c0 3 1 5.8 3 8l3-3z" />
        </svg>
    </div>

    <!-- Header -->
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Header con filtros -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Services') }}</h1>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <!-- Barra de búsqueda -->
                <x-shared.search-input wireModel="search" placeholder="{{ __('Search Service') }}" />

                <!-- Filtro por estado -->
                <select wire:model.live="statusFilter"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm cursor-pointer px-1 mx-1.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="active">Activos</option>
                    <option value="inactive">Inactivos</option>
                    <option value="all">Todos</option>
                </select>

                <!-- Botón Nuevo Servicio -->
                <x-shared.create-button href="{{ route('services.create') }}" text="{{ __('New Service') }}" />
            </div>
        </div>

        <!-- Mensaje de éxito -->
        <x-shared.message-success />

        <!-- Mensaje de error -->
        <x-shared.message-error />

        <!-- Grid de servicios -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($services as $service)
                <div
                    class="bg-white dark:bg-neutral-800 rounded-2xl shadow-md border border-gray-100 dark:border-neutral-700 overflow-hidden flex flex-col transition duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-amber-50/20 dark:hover:bg-neutral-700/50">

                    <!-- Imagen -->
                    @if ($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="Imagen del servicio"
                            class="w-full h-48 object-contain bg-gray-200 p-2 border-b dark:border-neutral-600">
                    @else
                        <img src="{{ $service->image_url }}" alt="{{ $service->name }}"
                            class="w-full h-48 object-contain bg-gray-200 p-2 border-b dark:border-neutral-600" />
                    @endif

                    <!-- Contenido -->
                    <div class="p-4 space-y-3 flex-1 flex flex-col justify-between">
                        <!-- Nombre del servicio -->
                        <div class="flex items-center gap-2">
                            <x-lucide-scissors class="w-5 h-5 text-amber-600 dark:text-amber-400" />
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-1">
                                {{ $service->name }}
                            </h2>
                        </div>

                        <!-- Descripción -->
                        <div class="flex items-start gap-2 text-sm text-gray-600 dark:text-neutral-300">
                            <x-lucide-file-text class="w-4 h-4 mt-1 text-gray-500 dark:text-gray-400" />
                            <p class="line-clamp-2 leading-relaxed">
                                {{ $service->description }}
                            </p>
                        </div>

                        <!-- Precio y estado -->
                        <div class="flex justify-between items-center text-sm pt-2">
                            <div class="flex items-center gap-1 font-semibold text-amber-600 dark:text-amber-400">
                                <x-lucide-dollar-sign class="w-4 h-4" />
                                {{ number_format($service->price, 0, ',', '.') }}
                            </div>

                            <div class="flex items-center gap-1">
                                @if ($service->status)
                                    <x-lucide-check-circle class="w-4 h-4 text-green-600" />
                                    <span class="text-green-600 text-xs">Activo</span>
                                @else
                                    <x-lucide-x-circle class="w-4 h-4 text-red-500" />
                                    <span class="text-red-500 text-xs">Inactivo</span>
                                @endif
                            </div>
                        </div>

                        <!-- Acciones -->
                        <div class="flex justify-between items-center pt-4 border-t dark:border-neutral-700 mt-3 pt-3">
                            <a href="{{ route('services.edit', $service) }}"
                                class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                                <x-lucide-pencil class="w-4 h-4" />
                                Editar
                            </a>

                            <!-- Toggle -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:click="changeStatus({{ $service->id }})"
                                    class="sr-only peer" @checked($service->status)>
                                <div
                                    class="w-9 h-5 bg-gray-300 dark:bg-neutral-600 rounded-full peer peer-checked:bg-amber-500 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-neutral-400">
                    No hay servicios registrados.
                </div>
            @endforelse
        </div>

    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $services->links() }}
    </div>
</div>
