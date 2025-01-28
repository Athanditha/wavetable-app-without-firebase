<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Oops! Something went wrong</title>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-600">Oops!</h1>
        <p class="text-2xl mt-4 text-gray-700">Something went wrong.</p>
        <p class="text-lg text-gray-500 mt-2">It looks like you don't have the necessary permissions to access this page.</p>
        
        <div class="mt-8">
            <a href="/home" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Go to Home
            </a>
        </div>
    </div>
</body>
</html>
