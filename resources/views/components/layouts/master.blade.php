<!DOCTYPE html>
<html lang="en" {{ $attributes }}>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Accountable - {{ $title ?? 'Dashboard' }} </title>
        @livewireStyles @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body {{ $attributes }}>

        {{ $slot }}
        
        @livewireScripts
    </body>
</html>
