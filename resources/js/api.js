export async function apiRequest(url, options = {}) {
    // Get the token from session storage
    const token = document.querySelector('meta[name="sanctum-token"]')?.content;
    
    // Set default headers
    const headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    };

    // Add authorization header if token exists
    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    // Merge headers with any provided options
    const requestOptions = {
        ...options,
        headers: {
            ...headers,
            ...options.headers
        }
    };

    try {
        const response = await fetch(url, requestOptions);
        
        if (response.status === 401) {
            // Handle unauthorized access
            window.location.href = '/admin/login';
            return;
        }

        return response;
    } catch (error) {
        console.error('API Request Error:', error);
        throw error;
    }
} 