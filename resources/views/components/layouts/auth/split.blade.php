<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="flex min-h-dvh flex-col lg:flex-row">
        <!-- Columna de la Imagen -->
        <div class="relative hidden bg-neutral-900 lg:block lg:w-[55%] xl:w-[60%]">
            <div class="sticky top-0 flex h-dvh flex-col p-8 lg:p-10">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="z-20 mb-6 flex items-center text-lg font-medium" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-md">
                        <x-app-logo-icon class="me-2 h-7 fill-current text-white" />
                    </span>
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- Imagen -->
                <div class="flex flex-1 items-center justify-center p-2">
                    <div class="h-full w-full overflow-hidden">
                        <img src="{{ asset('assets/images/barber-booker.jpg') }}" alt="Barbería profesional"
                            class="h-full w-full object-cover object-center rounded-lg shadow-2xl"
                            style="min-height: 450px;">
                    </div>
                </div>

                <!-- Cita inspiracional más compacta -->
                @php
                    [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                @endphp

                <div class="mt-6 text-white">
                    <blockquote class="space-y-1">
                        <flux:heading size="lg" class="italic leading-tight">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                        <footer class="mt-2">
                            <flux:heading size="sm" class="font-normal opacity-80">— {{ trim($author) }}</flux:heading>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>

        <!-- Columna del Formulario -->
        <div class="flex w-full items-center justify-center p-6 sm:p-8 lg:w-[45%] xl:w-[40%]">
            <div class="w-full max-w-md">
                <!-- Logo móvil más discreto -->
                <a href="{{ route('home') }}" class="mb-6 flex justify-center lg:hidden" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-md">
                        <x-app-logo-icon class="h-8 fill-current text-black dark:text-white" />
                    </span>
                </a>

                <!-- Contenedor del formulario -->
                <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-neutral-800/50 dark:shadow-none sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>