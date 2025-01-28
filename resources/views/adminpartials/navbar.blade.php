<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaveTable Management</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        /* Default light mode styles */
        body {
            transition: background-color 0.3s, color 0.3s;
        }
        .dark-mode body {
            background-color: #111;
            color: #eee;
        }
        .dark-mode .bg-black {
            background-color: #333;
        }
        .dark-mode .text-white {
            color: #ccc;
        }
        .dark-mode .hover\:text-gray-300:hover {
            color: #999;
        }
    </style>
</head>
<body>
    <nav class="bg-black p-4">
        <div class="container mx-auto flex items-center justify-between flex-wrap">

            <!-- Logo and Title Section -->
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('darklogo.png') }}" alt="Logo" class="h-16 w-auto">
                    <p class="text-white text-2xl font-bold ml-4 hidden md:block">WaveTable Management</p>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex-grow">
                <!-- Hidden on small screens -->
                <div class="hidden lg:flex lg:items-center lg:justify-end space-x-4">
                    <a href="/items" class="text-white text-lg font-semibold hover:text-gray-300 transition duration-300 py-2 px-4">Items</a>
                    <!-- Log Out Button -->
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white text-lg font-semibold hover:text-gray-300 transition duration-300 py-2 px-4">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>

            <!-- Dark Mode Toggle Button -->
            <div class="flex items-center space-x-4">
                <button id="dark-mode-toggle" class="text-white focus:outline-none">
                    <svg id="dark-mode-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path id="sun-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 14v1m7-7h1M4 12H3m14.35-4.35l.7-.7m-11.2 0l.7.7m11.2 11.2l.7.7m-11.2 0l.7-.7"></path>
                        <path id="moon-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.7 15.1a9.953 9.953 0 01-4.4 1.3c-5.5 0-10-4.5-10-10a9.953 9.953 0 011.3-4.4 6.978 6.978 0 01-.8 13.1c4.4 0 8 3.6 8 8a6.978 6.978 0 01-3.1-.7z"></path>
                    </svg>
                </button>

                <!-- Hamburger Icon for Mobile Menu -->
                <div class="block lg:hidden">
                    <button id="menu-toggle" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="lg:hidden">
            <div class="hidden" id="menu">
                <ul class="flex flex-col items-end p-4 space-y-2 bg-black text-white">
                    <li><a href="/items" class="text-lg font-semibold hover:text-gray-300 transition duration-300">Items</a></li>
                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-lg font-semibold hover:text-gray-300 transition duration-300">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- JavaScript to Toggle Dark Mode and Menu on Small Screens -->
    <script>
        document.getElementById('dark-mode-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            var sunIcon = document.getElementById('sun-icon');
            var moonIcon = document.getElementById('moon-icon');
            if (document.body.classList.contains('dark-mode')) {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            } else {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        });

        document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
