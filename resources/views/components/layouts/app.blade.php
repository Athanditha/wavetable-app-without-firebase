<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Livewire App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div>
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>
