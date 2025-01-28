<nav class="bg-black text-white border-b border-gray-800 shadow-lg">
    <div class="container mx-auto px-8 py-4">
        <div class="flex justify-between items-center gap-8">
            <!-- Logo Section -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('darklogo.png') }}" alt="Logo" class="h-16 w-auto transform transition-all duration-300 hover:scale-105">
                </a>
            </div>

            <!-- Search Bar - Centered -->
            <div class="flex-1 max-w-2xl">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        </div>
                        <input type="search" 
                               id="searchInput"
                               name="query"
                               placeholder="Search for audio equipment..." 
                               class="w-full pl-12 pr-6 py-3 text-sm text-black
                                      bg-gray-900/50 
                                      border border-gray-700
                                      rounded-full
                                      placeholder-gray-400
                                      transition-all duration-300
                                      focus:outline-none 
                                      focus:border-blue-500
                                      focus:ring-2 
                                      focus:ring-blue-500/50
                                      focus:bg-gray-900
                                      hover:bg-gray-900/70">
                    </div>
                    <!-- Search Results Dropdown -->
                    <div id="searchResults" class="absolute z-50 mt-2 w-full bg-white rounded-lg shadow-xl border border-gray-700 hidden">
                        <div id="searchLoading" class="p-4 text-center hidden">
                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 bg-white border-blue-500 mx-auto"></div>
                        </div>
                        <div id="searchResultsList" class="max-h-96 overflow-y-auto divide-y bg-white divide-gray-700"></div>
                    </div>
                </form>
            </div>

            <!-- Navigation Links & Auth Buttons -->
            <div class="flex items-center gap-6">
                @if(Auth::check())
                    <div class="flex items-center gap-6">
                        @if(Auth::user()->usertype === 'admin')
                            <div class="flex items-center gap-6">
                                <span class="p-3 bg-blue-600 text-white rounded-lg font-medium">
                                    {{ Auth::user()->name }}
                                </span>
                                <a href="{{ url('/admin') }}" 
                                   class="text-gray-300 font-medium">
                                    Dashboard
                                </a>
                            </div>
                        @else
                            <div class="flex items-center gap-6">
                                <span class="p-3 bg-red-600 text-white rounded-lg font-medium">
                                    {{ Auth::user()->name }}
                                </span>
                                <a href="{{ url('/') }}" 
                                   class="text-gray-300 transition-colors duration-300 font-medium">
                                    Items
                                </a>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="px-5 py-2.5 bg-red-900/30 text-red-400 rounded-lg hover:bg-red-900/50 
                                         transition-all duration-300 font-medium text-sm">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('user.login') }}" 
                           class="px-5 py-2.5 bg-blue-900/30 text-white rounded-lg hover:bg-blue-900/50 
                                  transition-all duration-300 font-medium text-sm">
                            Login as User
                        </a>
                        <a href="{{ route('admin.login') }}" 
                           class="px-5 py-2.5 bg-green-900/30 text-white rounded-lg hover:bg-green-900/50 
                                  transition-all duration-300 font-medium text-sm">
                            Login as Admin
                        </a>
                        <a href="{{ route('register') }}" 
                           class="px-5 py-2.5 bg-purple-900/30 text-purple-400 rounded-lg hover:bg-purple-900/50 
                                  transition-all duration-300 font-medium text-sm">
                            Register
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const searchLoading = document.getElementById('searchLoading');
    const searchResultsList = document.getElementById('searchResultsList');

    function performSearch(query) {
        searchResults.classList.remove('hidden');
        searchLoading.classList.remove('hidden');
        searchResultsList.innerHTML = '';

        fetch(`/api/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                searchLoading.classList.add('hidden');
                searchResultsList.innerHTML = '';
                
                if (data.count > 0) {
                    data.results.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'p-3 bg-white hover:bg-gray-800 transition duration-150';
                        div.innerHTML = `
                            <a href="/items/${item.id}" class="flex items-center space-x-4">
                                <img src="${item.image || '/images/placeholder.jpg'}" 
                                     alt="${item.name}" 
                                     class="w-12 h-12 object-cover rounded-lg"
                                     onerror="this.src='/images/placeholder.jpg'">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-black truncate">${item.name}</p>
                                    <p class="text-sm text-gray-400">${item.brand || 'No brand'}</p>
                                    <p class="text-sm font-semibold text-black ">RM ${parseFloat(item.sale_price).toFixed(2)}</p>
                                </div>
                            </a>
                        `;
                        searchResultsList.appendChild(div);
                    });
                } else {
                    searchResultsList.innerHTML = `
                        <div class="p-4 text-center text-gray-400">
                            No results found
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                searchLoading.classList.add('hidden');
                searchResultsList.innerHTML = `
                    <div class="p-4 text-center text-red-400">
                        Error loading results
                    </div>
                `;
            });
    }

    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.trim();
        clearTimeout(searchTimeout);
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(() => performSearch(query), 300);
        } else {
            searchResults.classList.add('hidden');
        }
    });

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.closest('form').submit();
        }
    });

    document.addEventListener('click', function(e) {
        if (!searchResults.contains(e.target) && !searchInput.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });
});
</script>
