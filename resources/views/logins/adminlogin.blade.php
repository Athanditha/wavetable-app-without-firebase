<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaveTable | Admin Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-primary flex items-center justify-center min-h-screen font-sans">
    <div class="flex flex-col items-center">
        <div class="mb-8">
            <img src="{{ asset('darklogo.png') }}" alt="WaveTable Logo" class="w-96">
        </div>
        <div class="bg-transparent border-2 border-secondary p-8 rounded-xl w-96 shadow-soft">
            <form method="POST" action="{{ route('adminlogin') }}" class="flex flex-col space-y-4">
                @csrf
                <div class="flex flex-col">
                    <label for="email" class="text-secondary text-lg font-heading">E-Mail</label>
                    <input type="email" id="email" name="email" class="px-4 py-2 rounded bg-card text-primary focus:outline-none" required>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="text-secondary text-lg font-heading">Password</label>
                    <input type="password" id="password" name="password" class="px-4 py-2 rounded bg-card text-primary focus:outline-none" required>
                </div>
                <button type="submit" class="bg-secondary text-primary py-2 rounded-lg hover:bg-hover-link transition">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
