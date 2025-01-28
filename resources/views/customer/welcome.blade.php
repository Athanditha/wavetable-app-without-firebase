<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wavetable | Home</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-secondary text-primary font-sans h-full">
    <!-- Navbar -->
    @include('customerpartials.navbarrep')

    <!-- Welcome Section -->
    <section class="py-16 bg-secondary">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Wavetable</h1>
            <p class="text-xl mb-6 text">Explore the best in musical equipment and take your sound to the next level!</p>
            <a href="/" class="bg-secondary hover:bg-primary text-primary hover:text-secondary font-bold py-2 px-4 rounded transition-colors duration-300">Shop Now</a>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-16 bg-primary text-secondary">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Gallery</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Example Gallery Item -->
                <div class="bg-white p-0 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('Sound-Design-Studio-Mixer.jpg') }}" alt="Gallery Image 1" class="w-full h-64 object-cover">
                </div>
                <div class="bg-white p-0 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('salvatoreganacci.jpg') }}" alt="Gallery Image 2" class="w-full h-64 object-cover">
                </div>
                <div class="bg-white p-0 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('Bring-Me-The-Horizon.jpg') }}" alt="Gallery Image 3" class="w-full h-64 object-cover">
                </div>
                <div class="bg-white p-0 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('studio-picture.jpg') }}" alt="Gallery Image 4" class="w-full h-64 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-background text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl text-secondary font-bold mb-8">What Our Customers Say</h2>
            <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-8">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto">
                    <p class="text-gray-700 mb-4">"Wavetable has an incredible selection of musical gear. The quality is unmatched and the service is top-notch!"</p>
                    <p class="font-semibold">John Doe</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Signup Section -->
    <section class="py-16 bg-primary text-secondary text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Stay Updated</h2>
            <p class="text-lg mb-6">Sign up for our newsletter and be the first to know about new arrivals, special offers, and more!</p>
            <form action="/subscribe" method="POST" class="max-w-md mx-auto">
                @csrf
                <input type="email" name="email" placeholder="Enter your email" class="w-full p-3 rounded-lg mb-4 border border-gray-300" required>
                <button type="submit" class="bg-secondary hover:bg-primary text-primary hover:text-secondary font-bold py-2 px-4 rounded transition-colors duration-300">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    @include('customerpartials.footer')
</body>
</html>
