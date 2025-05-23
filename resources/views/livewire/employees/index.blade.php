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
    <div class="flex flex-col gap-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Empleados</h1>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <x-shared.search-input wireModel="search" placeholder="Buscar empleado..." />

                <select wire:model.live="statusFilter"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm px-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="active">Activos</option>
                    <option value="inactive">Inactivos</option>
                    <option value="all">Todos</option>
                </select>

                <x-shared.create-button href="{{ route('employees.create') }}" text="Nuevo empleado" />
            </div>
        </div>

        <x-shared.message-success />
        <x-shared.message-error />

        <!-- Grid de empleados -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
            @forelse ($employees as $employee)
                <div class="bg-white dark:bg-gray-700/30 rounded-xl shadow border dark:border-gray-700 p-4 flex gap-4 overflow-hidden transition duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-amber-50/20 dark:hover:bg-gray-700/50">
                    <!-- Foto del empleado -->
                    <div class="flex-shrink-0">
                        @if ($employee->image)
                            <img src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->name }}"
                                class="w-24 h-24 object-cover rounded-lg border shadow">
                        @else
                            <img src="{{ $employee->image_url }}" alt="{{ $employee->name }}"
                                class="w-24 h-24 object-cover rounded-lg border shadow" />
                        @endif
                    </div>

                    <!-- Info del empleado -->
                    <div class="flex flex-col justify-between w-full">
                        <div class="space-y-1">
                            <!-- Nombre -->
                            <div class="flex items-center gap-2 text-gray-900 dark:text-white font-semibold text-lg">
                                <x-lucide-user class="w-4 h-4 text-amber-500" />
                                {{ $employee->name }}
                            </div>

                            <!-- Especialidad -->
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                <x-lucide-briefcase class="w-4 h-4 text-amber-500" />
                                {{ $employee->specialty->name ?? '-' }}
                            </div>

                            <!-- Email -->
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                <x-lucide-mail class="w-4 h-4 text-amber-500" />
                                {{ $employee->email }}
                            </div>

                            <!-- Teléfono -->
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                <x-lucide-phone class="w-4 h-4 text-amber-500" />
                                {{ $employee->phone }}
                            </div>

                            <!-- Biografía -->
                            <div class="flex items-start gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <x-lucide-file-text class="w-4 h-4 text-amber-500 mt-0.5" />
                                <p class="line-clamp-2">{{ $employee->biography }}</p>
                            </div>

                            <!-- Calificación -->
                            <div class="flex items-center gap-1 mt-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= 4)
                                        {{-- Reemplaza 4 por $employee->rating cuando tengas ese dato --}}
                                        <x-lucide-star class="h-4 w-4 text-amber-500" />
                                    @else
                                        <x-lucide-star class="h-4 w-4 text-gray-300 dark:text-gray-600" />
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <!-- Acciones -->
                        <div class="flex justify-between items-center mt-4 border-t pt-2 dark:border-gray-600 text-sm">
                            <!-- Editar -->
                            <a href="{{ route('employees.edit', $employee) }}"
                                class="text-blue-600 dark:text-blue-400 font-medium hover:underline flex items-center gap-1">
                                <x-lucide-pencil class="w-4 h-4" />
                                Editar
                            </a>

                            <!-- Switch de estado -->
                            <div class="flex items-center gap-2">
                                @if ($employee->status)
                                    <x-lucide-check-circle class="w-4 h-4 text-green-600" />
                                    <span class="text-green-600 text-xs">Activo</span>
                                @else
                                    <x-lucide-x-circle class="w-4 h-4 text-red-500" />
                                    <span class="text-red-500 text-xs">Inactivo</span>
                                @endif

                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:click="changeStatus({{ $employee->id }})"
                                        class="sr-only peer" @checked($employee->status)>
                                    <div
                                        class="w-9 h-5 bg-gray-300 dark:bg-neutral-600 rounded-full peer peer-checked:bg-amber-500 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500 dark:text-gray-400">No hay empleados registrados.</p>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $employees->links() }}
        </div>
    </div>
</div>
