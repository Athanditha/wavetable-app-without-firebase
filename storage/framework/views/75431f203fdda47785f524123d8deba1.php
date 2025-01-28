<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaveTable Analytics</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="bg-white text-gray-900">
    <?php echo $__env->make('customerpartials.navbarrep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Analytics Dashboard</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-gray-500 text-sm">Total Items</h3>
                <p class="text-2xl font-bold"><?php echo e($analyticsData['totalItems']); ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-gray-500 text-sm">Total Inventory Value</h3>
                <p class="text-2xl font-bold">USD<?php echo e(number_format($analyticsData['totalValue'], 2)); ?></p>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Categories Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Items by Category</h2>
                <div id="categoriesChart"></div>
            </div>

            <!-- Top Items Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Top Items by Price</h2>
                <div id="topItemsChart"></div>
            </div>

            <!-- Order Types Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Order Distribution</h2>
                <div id="orderTypesChart"></div>
            </div>

            <!-- Brands Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Items by Brand</h2>
                <div id="brandsChart"></div>
            </div>
        </div>
    </div>

    <script>
        // Categories Pie Chart
        const categoriesOptions = {
            series: <?php echo json_encode($analyticsData['categories']['data'], 15, 512) ?>,
            chart: {
                type: 'pie',
                height: 350
            },
            labels: <?php echo json_encode($analyticsData['categories']['labels'], 15, 512) ?>,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        // Top Items Chart
        const topItemsOptions = {
            series: [{
                data: <?php echo json_encode($analyticsData['topItems']['data'], 15, 512) ?>
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: <?php echo json_encode($analyticsData['topItems']['labels'], 15, 512) ?>,
            }
        };


        // Brands Chart
        const brandsOptions = {
            series: [{
                data: <?php echo json_encode($analyticsData['brands']['data'], 15, 512) ?>
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                }
            },
            xaxis: {
                categories: <?php echo json_encode($analyticsData['brands']['labels'], 15, 512) ?>,
                labels: {
                    rotate: -45
                }
            }
        };

        // Initialize Charts
        new ApexCharts(document.querySelector("#categoriesChart"), categoriesOptions).render();
        new ApexCharts(document.querySelector("#topItemsChart"), topItemsOptions).render();
        new ApexCharts(document.querySelector("#brandsChart"), brandsOptions).render();
    </script>

    <?php echo $__env->make('customerpartials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html> <?php /**PATH C:\xampp\htdocs\wavetable-app\resources\views/adminlanding/analytics.blade.php ENDPATH**/ ?>