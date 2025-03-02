function apiFetch(uri, options = {}) {
    const baseURL = 'http://localhost:8080/api',
        token = localStorage.getItem('token');
    const defaultHeaders = {};
    if (token) {
        defaultHeaders.Authorization = `Bearer ${token}`;
    }
    return fetch(`${baseURL}${uri}`, {
        ...options,
        headers: {...defaultHeaders, ...options.headers},
    })
        .then(async response => {
            if (!response.ok) {
                if (window.location.href !== 'http://localhost:8080/login'){
                    window.location.href = '/login';
                }
                const error = new Error("HTTP error");
                error.data = await response.json();
                throw error;
            }
            return response.json();
        })
        .catch(error => {
            throw error;
        });
}

export default apiFetch;