<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black">
    <div>
            <a href="/" class="flex items-center">
                <img src="<?php echo e(asset('darklogo.png')); ?>" alt="Logo" class="h-20 p-0 w-auto transition-transform duration-300 ease-in-out hover:scale-110">
            </a>
    </div>


    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-xl font-bold text-gray-800 text-center mb-4">Admin Login</h2>

        <form wire:submit.prevent="login">
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    wire:model="email" 
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    wire:model="password" 
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    placeholder="Enter your password"
                    required
                >
            </div>

            <div class="flex items-center justify-between mt-4">
                <button 
                    type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 transition ease-in-out duration-150"
                >
                    Login
                </button>
                <a href="#" class="text-sm text-indigo-500 hover:text-indigo-700 focus:outline-none focus:underline">Forgot password?</a>
            </div>

            <!--[if BLOCK]><![endif]--><?php if(session('error')): ?>
                <p class="text-red-600 text-sm mt-4"><?php echo e(session('error')); ?></p>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </form>
    </div>
</div>

<script>
    // Listen for Livewire event
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('auth-success', (event) => {
            localStorage.setItem('token', event.token);
        });
    });

    // Also check session for token on page load
    document.addEventListener('DOMContentLoaded', function() {
        <!--[if BLOCK]><![endif]--><?php if(session('token')): ?>
            localStorage.setItem('token', '<?php echo e(session('token')); ?>');
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    });
</script>
<?php /**PATH C:\xampp\htdocs\wavetable-app\resources\views/livewire/admin-login.blade.php ENDPATH**/ ?>