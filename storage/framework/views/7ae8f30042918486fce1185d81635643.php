<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>Edit Item</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body class="bg-black text-white min-h-screen">
    <?php echo $__env->make('customerpartials.navbarrep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold text-center mb-12">Edit Item</h1>

        <div class="max-w-2xl mx-auto bg-gray-900 rounded-xl shadow-2xl p-8 border border-white/20">
            <form id="editItemForm">
                <?php echo csrf_field(); ?>
                <div class="space-y-6">
                    <div>
                        <label for="brand" class="block text-sm font-medium mb-2 text-gray-300">Brand</label>
                        <input id="brand" name="brand" type="text" 
                            class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                            required>
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium mb-2 text-gray-300">Name</label>
                        <input id="name" name="name" type="text" 
                            class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                            required>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium mb-2 text-gray-300">Category</label>
                        <input id="category" name="category" type="text" 
                            class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                            required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium mb-2 text-gray-300">Description</label>
                        <textarea id="description" name="description" 
                            class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                            rows="3" required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="quantity" class="block text-sm font-medium mb-2 text-gray-300">Quantity</label>
                            <input id="quantity" name="quantity" type="number" 
                                class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                required>
                        </div>

                        <div>
                            <label for="sale_price" class="block text-sm font-medium mb-2 text-gray-300">Sale Price</label>
                            <input id="sale_price" name="sale_price" type="number" step="0.01" 
                                class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                required>
                        </div>
                    </div>

                    <div>
                        <label for="rental_rate" class="block text-sm font-medium mb-2 text-gray-300">Rental Rate (Monthly)</label>
                        <input id="rental_rate" name="rental_rate" type="number" step="0.01" 
                            class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                            required>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium mb-2 text-gray-300">Image</label>
                        <input id="image" name="image" type="file" 
                            class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white">
                        <input type="hidden" id="existing_image" name="existing_image">
                    </div>

                    <div class="flex gap-4 mt-8">
                        <button type="submit" 
                            class="flex-1 bg-white hover:bg-gray-200 text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                            Update Item
                        </button>
                        <a href="/items" 
                            class="flex-1 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get item ID from URL
        const pathParts = window.location.pathname.split('/');
        const itemId = pathParts[pathParts.length - 2];
        const token = document.querySelector('meta[name="csrf-token"]').content;

        // Use the item data passed from controller instead of making API call
        const item = <?php echo json_encode($item, 15, 512) ?>;
        
        // Populate form fields with existing data
        document.getElementById('brand').value = item.brand || '';
        document.getElementById('name').value = item.name || '';
        document.getElementById('category').value = item.category || '';
        document.getElementById('description').value = item.description || '';
        document.getElementById('quantity').value = item.quantity || '';
        document.getElementById('sale_price').value = item.sale_price || '';
        document.getElementById('rental_rate').value = item.rental_rate || '';
        
        // Set existing image
        if (item.image) {
            document.getElementById('existing_image').value = item.image;
        }

        // Form submission handler
        document.getElementById('editItemForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            // Ensure method and existing image are included
            formData.append('_method', 'PUT');
            
            fetch(`/api/items/${itemId}`, {
                method: 'POST', // Keep as POST, Laravel will interpret _method: PUT
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || `HTTP error! status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Update successful:', data);
                alert('Item updated successfully!');
                window.location.href = '/admin/items';
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Error updating item. Please try again.');
            });
        });
    });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\wavetable-app\resources\views/items/edititem.blade.php ENDPATH**/ ?>