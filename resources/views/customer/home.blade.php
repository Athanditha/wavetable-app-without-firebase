<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaveTable | Professional Audio Equipment</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-900 font-sans">
    @include('customerpartials.navbarrep')

    <!-- Hero Section -->
    <section class="relative h-[600px] bg-gray-200">
        <div class="relative container mx-auto py-6 bg-gray-200 h-full flex items-center">
        </div>
        <div class="relative container mx-auto py-6 bg-gray-200 h-full flex items-center">
            <div class="max-w-3xl">
                <h1 class="text-6xl font-bold mb-4 text-gray-900">Professional Audio Equipment</h1>
                <p class="text-xl mb-8 text-gray-700">Discover premium sound equipment for studio, live performance, and professional audio production.</p>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="pb-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold py-6 text-gray-900">Featured Equipment</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" id="featuredItems">
                <!-- Items will be loaded here -->
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('token');
            
            function fetchItems() {
                fetch('/api/items', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token ? `Bearer ${token}` : ''
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(items => {
                    const itemsContainer = document.getElementById('featuredItems');
                    itemsContainer.innerHTML = items.map(item => `
                        <div class="bg-white rounded-xl overflow-hidden group hover:shadow-xl transition duration-300 border border-gray-200">
                            <div class="relative aspect-square overflow-hidden">
                                ${item.image 
                                    ? `<img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">`
                                    : `<img src="{{ asset('images/default-image.jpg') }}" alt="${item.name}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">`
                                }
                                <div class="absolute top-4 right-4">
                                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                                        ${item.category}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <div class="mb-4">
                                    <h3 class="text-xl font-bold mb-1 text-gray-900">${item.name}</h3>
                                    <p class="text-gray-600 text-sm">${item.brand}</p>
                                </div>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">${item.description}</p>
                                
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Sale Price</p>
                                        <p class="text-xl font-bold text-blue-600">$${Number(item.sale_price).toFixed(2)}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Rental</p>
                                        <p class="text-xl font-bold text-blue-600">$${Number(item.rental_rate).toFixed(2)}/mo</p>
                                    </div>
                                </div>
                                
                                <div class="flex gap-2">
                                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-300">
                                        Add to Cart
                                    </button>
                                    <button class="flex-none w-12 h-10 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg flex items-center justify-center transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('featuredItems').innerHTML = `
                        <div class="col-span-full text-center text-gray-600">
                            Unable to load items. Please try again later.
                        </div>
                    `;
                });
            }

            fetchItems();
        });
    </script>

    @include('customerpartials.footer')
</body>
</html>
