<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black">
    <div>
        <a href="/" class="flex items-center">
            <img src="{{ asset('darklogo.png') }}" alt="Logo" class="h-20 p-0 w-auto transition-transform duration-300 ease-in-out hover:scale-110">
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-xl font-bold text-gray-800 text-center mb-4">User Login</h2>

        <form wire:submit.prevent="login">
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    wire:model="email" 
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
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
                    required
                >
            </div>

            <div class="flex items-center justify-between mt-4">
                <a 
                    href="{{ route('password.request') }}" 
                    class="text-sm text-indigo-500 hover:text-indigo-700 focus:outline-none focus:underline"
                >
                    Forgot your password?
                </a>
                <button 
                    type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                    Login
                </button>
            </div>

            @if (session('error'))
                <p class="text-red-500 text-sm mt-4">{{ session('error') }}</p>
            @endif
        </form>
    </div>
</div>
