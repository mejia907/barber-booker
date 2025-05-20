<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-700/30 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('Edit Service') }}
            </h1>
            <a href="{{ route('services.index') }}"
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
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"> {{ __('Name') }}
                    <span class="text-red-500">*</span></label>
                <input type="text" wire:model.defer="name"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700/30 px-4 py-2 text-gray-900 dark:text-white">
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Duración -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"> {{ __('Duration') }}
                    <span class="text-red-500">*</span></label>
                <input type="number" wire:model.defer="duration"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700/30 px-4 py-2 text-gray-900 dark:text-white">
                @error('duration')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Precio -->
            <div>
                <label
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Price') }}</label>
                <input type="text" id="priceInput" wire:model.defer="price"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700/30 px-4 py-2 text-gray-900 dark:text-white">
                @error('price')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categoría -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"> {{ __('Category') }}
                    <span class="text-red-500">*</span></label>
                <select wire:model.defer="category_id"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700/30 px-4 py-2 text-gray-900 dark:text-white">
                    <option value="">-- {{ __('Select a category') }} --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"> {{ __('Description') }}
                    <span class="text-red-500">*</span></label>
                <textarea wire:model.defer="description" rows="3"
                    class="w-full rounded-lg border border-gray-300 dark:border-neutral-600 bg-white dark:bg-gray-700/30 px-4 py-2 text-gray-900 dark:text-white"></textarea>
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imagen actual -->
            @if ($imagePath)
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Current Image') }}</label>
                    <img src="{{ asset('storage/' . $imagePath) }}" class="h-32 rounded object-cover">
                </div>
            @endif

            <!-- Nueva imagen -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Change Image') }}</label>
                 <input type="file" wire:model="image"
                    class="w-full text-gray-700 dark:text-white file:bg-amber-500 file:text-white file:rounded file:px-4 file:py-2">
                @error('image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror

                <!-- Previsualización -->
                @if ($image)
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">{{ __('Preview') }}:</p>
                    <img src="{{ $image->temporaryUrl() }}" class="h-32 mt-1 rounded object-cover">
                @endif
            </div>


            <!-- Botones -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-neutral-700">
                <a href="{{ route('services.index') }}"
                    class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" wire:loading.attr="disabled"
                    class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600 disabled:opacity-50 cursor-pointer">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>
