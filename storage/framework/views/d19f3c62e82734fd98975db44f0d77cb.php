<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - WaveTable</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-white">
    <?php echo $__env->make('customerpartials.navbarrep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Search Results</h1>
            <p class="text-gray-600">
                <?php echo e(count($results)); ?> results found for "<?php echo e($query); ?>"
            </p>
        </div>

        <?php if(count($results) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <?php if(isset($item['image'])): ?>
                            <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>" 
                                 class="w-full h-48 object-cover">
                        <?php endif; ?>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2"><?php echo e($item['name']); ?></h3>
                            <p class="text-gray-600 mb-4"><?php echo e($item['brand']); ?></p>
                            <p class="text-gray-800 mb-4 line-clamp-2"><?php echo e($item['description']); ?></p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold">USD <?php echo e(number_format($item['sale_price'], 2)); ?></span>
                                <a href="/items/<?php echo e($id); ?>" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <h2 class="text-2xl font-semibold mb-4">No results found</h2>
                <p class="text-gray-600">Try searching with different keywords</p>
            </div>
        <?php endif; ?>
    </div>

    <?php echo $__env->make('customerpartials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html> <?php /**PATH C:\xampp\htdocs\wavetable-app\resources\views/search/results.blade.php ENDPATH**/ ?>