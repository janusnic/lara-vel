<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">    

        <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Karla:400,700&display=swap'>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        

        <!-- Adds the Core Table Styles -->
        {{-- @rappasoftTableStyles --}}
        <!-- Adds any relevant Third-Party Styles (Used for DateRangeFilter (Flatpickr) and NumberRangeFilter) -->
        {{-- @rappasoftTableThirdPartyStyles --}}
        <!-- Adds the Core Table Scripts -->
        {{-- @rappasoftTableScripts --}}
        <!-- Adds any relevant Third-Party Scripts (e.g. Flatpickr) -->
        {{-- @rappasoftTableThirdPartyScripts --}}

        <tallstackui:script /> 
        <!-- Styles -->
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    
    <body class="bg-gray-100 flex">
        
        <x-admin.sidebar/>

        <div class="min-h-screen bg-gray-100 w-full">
            @livewire('admin.nav-bar')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow py-2">
                    {{ $header }}
                </header>
            @endif

            <main class="w-full flex-grow p-6">
                <x-admin.flesh/>
                {{ $slot }}
            </main>
        
        </div>
        
        @stack('modals')
        @livewireScripts

    </body>
</html>