<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>WaveTable | Registration</title>
</head>
<body class="bg-primary flex items-center justify-center min-h-screen font-sans">

    <div class="flex flex-col items-center space-y-8">

        <!-- Logo Section -->
        <div class="mb-8">
            <img src="{{ asset('darklogo.png') }}" alt="WaveTable Logo" class="w-96">
        </div>

        <!-- Registration Form -->
        <div class="bg-transparent border-2 border-secondary p-8 rounded-xl w-96 shadow-soft">
            <form action="{{ route('customer.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- First Name -->
                    <div class="col-span-1">
                        <label for="first_name" class="block text-secondary text-lg font-heading">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="w-full px-4 py-2 rounded bg-card text-primary focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>

                    <!-- Last Name -->
                    <div class="col-span-1">
                        <label for="last_name" class="block text-secondary text-lg font-heading">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-4 py-2 rounded bg-card text-primary focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Email -->
                    <div class="col-span-1">
                        <label for="email" class="block text-secondary text-lg font-heading">E-Mail</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded bg-card text-primary focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>

                    <!-- Contact Number -->
                    <div class="col-span-1">
                        <label for="contact_no" class="block text-secondary text-lg font-heading">Contact No.</label>
                        <input type="tel" id="contact_no" name="contact_no" class="w-full px-4 py-2 rounded bg-card text-primary focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- User Name -->
                    <div class="col-span-1">
                        <label for="user_name" class="block text-secondary text-lg font-heading">User Name</label>
                        <input type="text" id="user_name" name="user_name" class="w-full px-4 py-2 rounded bg-card text-primary focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>

                    <!-- Password -->
                    <div class="col-span-1">
                        <label for="password" class="block text-secondary text-lg font-heading">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded bg-card text-primary focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>
                </div>
                <!-- Register Errors -->
                @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                        <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                            @endforeach
                </ul>
                </div>
                @endif
                
                <!-- Register Button -->
                <button type="submit" class="w-full bg-secondary text-primary py-2 rounded-lg hover:bg-hover-link transition">
                    Register
                </button>
            </form>
        </div>
    </div>

</body>
</html>
