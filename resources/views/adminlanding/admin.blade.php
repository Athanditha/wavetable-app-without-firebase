<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>WaveTable Admin Dashboard</title>
</head>
<body class="bg-white text-gray-900 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-xl mx-auto px-6">
        <!-- Logo Section -->
        <div class="text-center mb-12">
            <img src="{{ asset('logolight.png') }}" alt="WaveTable Logo" class="w-48 mx-auto mb-8">
            <h1 class="text-3xl font-bold mb-2">Admin Dashboard</h1>
            <p class="text-gray-600">Manage your store with ease</p>
        </div>

        <!-- Dashboard Cards - Now Vertical -->
        <div class="space-y-4 mb-12">
            <a href="/admin/items" class="block">
                <div class="bg-white rounded-xl p-6 hover:bg-gray-50 transition duration-300 transform hover:scale-105 border border-gray-200 shadow-sm">
                    <h3 class="text-xl font-semibold mb-2">Item Management</h3>
                    <p class="text-gray-600">Manage your inventory, prices, and stock levels</p>
                </div>
            </a>
            
            <a href="/" class="block">
                <div class="bg-white rounded-xl p-6 hover:bg-gray-50 transition duration-300 transform hover:scale-105 border border-gray-200 shadow-sm">
                    <h3 class="text-xl font-semibold mb-2">View Store</h3>
                    <p class="text-gray-600">See your store as customers see it</p>
                </div>
            </a>

            <a href="/admin/analytics" class="block">
                <div class="bg-white rounded-xl p-6 hover:bg-gray-50 transition duration-300 transform hover:scale-105 border border-gray-200 shadow-sm">
                    <h3 class="text-xl font-semibold mb-2">Analytics</h3>
                    <p class="text-gray-600">Check your store's analytics</p>
                </div>
            </a>
        </div>

        <!-- Logout Section -->
        <div class="text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</body>
</html>