<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
            <script>
                  document.addEventListener('DOMContentLoaded', (event) => {
                  const startDateInput = document.getElementById('start_date');
                  const endDateInput = document.getElementById('end_date');

        // Ensure the end date is at least today or later when the page loads
                  const today = new Date().toISOString().split('T')[0];
                  startDateInput.setAttribute('min', today);
                  endDateInput.setAttribute('min', today);

        // Update the min attribute of the end date based on the start date
                  startDateInput.addEventListener('change', function() {
                      const startDate = this.value;
                      endDateInput.setAttribute('min', startDate);
                });
            });
            </script>
    </body>
</html>
