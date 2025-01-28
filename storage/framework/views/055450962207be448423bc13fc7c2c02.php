<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>WaveTable | Item Management</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body class="bg-black text-white min-h-screen">
    <?php echo $__env->make('customerpartials.navbarrep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold text-center mb-12">Inventory Management</h1>

        <div class="grid lg:grid-cols-2 gap-12 m-12">
            <!-- Add Section -->
            <div class="bg-gray-900 rounded-xl shadow-2xl p-8 border border-white/20">
                <h2 class="text-2xl font-bold mb-8 text-white">Add Equipment</h2>
                <form id="addItemForm">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-6">
                        <div>
                            <label for="brand" class="block text-sm font-medium mb-2 text-gray-300">Brand</label>
                            <input id="brand" name="brand" type="text" 
                                class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                placeholder="Brand" required>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium mb-2 text-gray-300">Name</label>
                            <input id="name" name="name" type="text" 
                                class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                placeholder="Name" required>
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium mb-2 text-gray-300">Category</label>
                            <input id="category" name="category" type="text" 
                                class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                placeholder="Category" required>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium mb-2 text-gray-300">Description</label>
                            <textarea id="description" name="description" 
                                class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                placeholder="Description" rows="3"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="quantity" class="block text-sm font-medium mb-2 text-gray-300">Quantity</label>
                                <input id="quantity" name="quantity" type="number" 
                                    class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                    placeholder="Quantity" required>
                            </div>

                            <div>
                                <label for="sale_price" class="block text-sm font-medium mb-2 text-gray-300">Sale Price</label>
                                <input id="sale_price" name="sale_price" type="number" step="0.01" 
                                    class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                    placeholder="Sale Price" required>
                            </div>
                        </div>

                        <div>
                            <label for="rental_rate" class="block text-sm font-medium mb-2 text-gray-300">Rental Rate (Monthly)</label>
                            <input id="rental_rate" name="rental_rate" type="number" step="0.01" 
                                class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white"
                                placeholder="Rental Rate" required>
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium mb-2 text-gray-300">Image</label>
                            <input id="image" name="image" type="file" 
                                class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-white">
                        </div>

                        <button type="submit" 
                            class="w-full bg-white hover:bg-gray-200 text-black font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                            Add Equipment
                        </button>
                    </div>
                </form>
            </div>

            <!-- Equipment Table -->
            <div class="bg-gray-900 rounded-xl shadow-2xl p-8 border border-white/20">
                <h2 class="text-2xl font-bold mb-8 text-white">Equipment List</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-800">
                                <th class="py-3 px-4 text-left text-gray-300">ID</th>
                                <th class="py-3 px-4 text-left text-gray-300">Brand</th>
                                <th class="py-3 px-4 text-left text-gray-300">Name</th>
                                <th class="py-3 px-4 text-left text-gray-300">Quantity</th>
                                <th class="py-3 px-4 text-left text-gray-300">Price</th>
                                <th class="py-3 px-4 text-left text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody">
                            <!-- Items will be loaded here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="csrf-token"]').content;

            function fetchItems() {
                fetch('/api/items', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const tbody = document.getElementById('itemsTableBody');
                    tbody.innerHTML = data.map(item => `
                        <tr class="border-b border-gray-800 hover:bg-gray-800 transition-colors">
                            <td class="py-3 px-4 text-gray-300">${item.id}</td>
                            <td class="py-3 px-4 text-gray-300">${item.brand}</td>
                            <td class="py-3 px-4 text-gray-300">${item.name}</td>
                            <td class="py-3 px-4 text-gray-300">${item.quantity}</td>
                            <td class="py-3 px-4 text-gray-300">$${Number(item.sale_price).toFixed(2)}</td>
                            <td class="py-3 px-4 space-x-2">
                                <button onclick="viewItem('${item.id}')" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                    View
                                </button>
                                <button onclick="editItem('${item.id}')" 
                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                    Edit
                                </button>
                                <button onclick="deleteItem('${item.id}')" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `).join('');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading items. Please check your authentication and try again.');
                });
            }

            // Add item form submission
            document.getElementById('addItemForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch('/api/items', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    fetchItems();
                    this.reset();
                    alert('Item added successfully!');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error adding item. Please check your input and try again.');
                });
            });

            // View item
            window.viewItem = function(id) {
                window.location.href = `/items/${id}`;
            }

            // Edit item
            window.editItem = function(id) {
                window.location.href = `/items/${id}/edit`;
            }

            // Delete item
            window.deleteItem = function(id) {
                if (confirm('Are you sure you want to delete this item?')) {
                    fetch(`/api/items/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('token')}`,
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(() => {
                        fetchItems();
                        alert('Item deleted successfully!');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting item. Please try again.');
                    });
                }
            }

            fetchItems();
        });
    </script>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\wavetable-app\resources\views/items/itemview.blade.php ENDPATH**/ ?>