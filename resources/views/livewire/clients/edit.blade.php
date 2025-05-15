<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('Edit Client') }}
            </h1>
            <a href="{{ route('clients.index') }}"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <form wire:submit.prevent="update" class="space-y-5">
            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre <span class="text-red-500">*</span></label>
                <input type="text" wire:model.defer="name"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700 px-4 py-2 text-gray-900 dark:text-white">
                @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" wire:model.defer="email"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700 px-4 py-2 text-gray-900 dark:text-white">
                @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Teléfono -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                <input type="text" wire:model.defer="phone"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700 px-4 py-2 text-gray-900 dark:text-white">
                @error('phone') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-neutral-700">
                <a href="{{ route('clients.index') }}"
                    class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100">
                     {{ __('Cancel') }}
                </a>
                <button type="submit" wire:loading.attr="disabled"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50">
                     {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>
