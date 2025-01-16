function apiFetch(uri, options = {}){
    const baseUrl = 'http://localhost:80/api',
        token = localStorage.getItem('token');
    const defaultHeaders = {};
    if (token) {
        defaultHeaders.Authorization = `Bearer ${token}`;
    }
    return fetch(`${baseUrl}${uri}`, {
        ...options,
            headers: {
                ...defaultHeaders,
                ...options.headers
            }
        })
        .then(async response=>{
            if (!response.ok) {
                if (response.status === 401) {
                    if (window.location.pathname !== '/login' || window.location.pathname !== '/register'){
                        window.location.href = '/login';
                        return;
                    }
                }
                const error = await response.json();
                throw new Error(error.message);
            }
            return response.json();
        })
        .catch(error => {
            throw error;
        })
}
export default apiFetch;