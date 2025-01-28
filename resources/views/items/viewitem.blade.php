<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>View Item</title>
</head>
<body class="bg-gray-50 p-0">

@include('customerpartials.navbarrep')

<div class="container mx-auto p-4 roboto-font">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-6">View Item</h1>
    
    <div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-700"></h2>
            <p class="text-sm text-gray-500"></p>
        </div>
        <div class="mb-4">
            <img src="" alt="" class="img-fluid w-full h-64 object-cover rounded-lg">
        </div>
        <div class="mb-4">
            <p class="text-gray-700 mb-2"><strong>Brand:</strong> <span id="brand"></span></p>
            <p class="text-gray-700 mb-2"><strong>Description:</strong> <span id="description"></span></p>
            <p class="text-gray-700 mb-2"><strong>Quantity:</strong> <span id="quantity"></span></p>
            <p class="text-gray-700 mb-2"><strong>Sale Price:</strong> $<span id="sale_price"></span></p>
            <p class="text-gray-700 mb-2"><strong>Rental Rate:</strong> $<span id="rental_rate"></span> per month</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const itemId = window.location.pathname.split('/').pop();
    
    fetch(`/api/items/${itemId}`, {
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(response => {
        const item = response.data;
        // Update page title
        document.title = `View Item - ${item.name}`;
        
        // Update content
        document.querySelector('h2').textContent = item.name;
        document.querySelector('p.text-sm').textContent = item.category;
        
        // Update image
        const imgElement = document.querySelector('.img-fluid');
        imgElement.src = item.image || '{{ asset("images/default-image.jpg") }}';
        imgElement.alt = item.name;
        
        // Update details
        document.getElementById('brand').textContent = item.brand;
        document.getElementById('description').textContent = item.description;
        document.getElementById('quantity').textContent = item.quantity;
        document.getElementById('sale_price').textContent = Number(item.sale_price).toFixed(2);
        document.getElementById('rental_rate').textContent = Number(item.rental_rate).toFixed(2);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading item details');
    });
});
</script>

</body>
</html>
