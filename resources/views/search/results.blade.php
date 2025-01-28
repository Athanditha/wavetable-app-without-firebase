<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - WaveTable</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    @include('customerpartials.navbarrep')

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Search Results</h1>
            <p class="text-gray-600">
                {{ count($results) }} results found for "{{ $query }}"
            </p>
        </div>

        @if(count($results) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($results as $id => $item)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        @if(isset($item['image']))
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" 
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $item['name'] }}</h3>
                            <p class="text-gray-600 mb-4">{{ $item['brand'] }}</p>
                            <p class="text-gray-800 mb-4 line-clamp-2">{{ $item['description'] }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold">USD {{ number_format($item['sale_price'], 2) }}</span>
                                <a href="/items/{{ $id }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <h2 class="text-2xl font-semibold mb-4">No results found</h2>
                <p class="text-gray-600">Try searching with different keywords</p>
            </div>
        @endif
    </div>

    @include('customerpartials.footer')
</body>
</html> 