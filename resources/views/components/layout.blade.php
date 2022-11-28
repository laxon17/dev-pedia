<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script defer src="/js/app.js"></script>
        <title>{{ $pageTitle ?? 'DevPedia - Welcome!' }}</title>
    </head>
    
    <body style="font-family: Open Sans, sans-serif">
        <section class="px-6 py-8">
            
            @include('partials._navigation')
    
            {{ $slot }}
    
            @include('partials._footer')
        </section>

       <x-flash-message />

    </body>
</html>