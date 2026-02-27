import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Add CSRF token to all requests
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Request interceptor for loading states
axios.interceptors.request.use(function (config) {
    // Show loading indicator
    document.body.classList.add('loading');
    return config;
}, function (error) {
    document.body.classList.remove('loading');
    return Promise.reject(error);
});

// Response interceptor for loading states
axios.interceptors.response.use(function (response) {
    // Hide loading indicator
    document.body.classList.remove('loading');
    return response;
}, function (error) {
    document.body.classList.remove('loading');
    
    // Handle common errors
    if (error.response) {
        switch (error.response.status) {
            case 401:
                window.location.href = '/login';
                break;
            case 403:
                alert('You do not have permission to perform this action.');
                break;
            case 404:
                alert('The requested resource was not found.');
                break;
            case 422:
                // Validation errors - handled by individual components
                break;
            case 500:
                alert('An internal server error occurred. Please try again later.');
                break;
            default:
                alert('An error occurred. Please try again.');
        }
    }
    
    return Promise.reject(error);
});