<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-700/30 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('New Client') }}
            </h1>
            <a href="{{ route('clients.index') }}"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <!-- Formulario -->
        <form wire:submit.prevent="save" class="space-y-5">
            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                     {{ __('Name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model.defer="name"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700/30 px-4 py-2 text-gray-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                     {{ __('Email') }} <span class="text-red-500">*</span>
                </label>
                <input type="email" wire:model.defer="email"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700/30 px-4 py-2 text-gray-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teléfono -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                     {{ __('Phone') }}
                </label>
                <input type="phone" wire:model.defer="phone"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700/30 px-4 py-2 text-gray-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-neutral-700">
                <a href="{{ route('clients.index') }}"
                    class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100">
                     {{ __('Cancel') }}
                </a>
                <button type="submit" wire:loading.attr="disabled"
                    class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-lg font-mclients.editum text-white hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 disabled:opacity-50 cursor-pointer">
                    <span wire:loading.remove wire:target="save">Guardar</span>
                    <span wire:loading wire:target="save">
                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
