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
                    if (window.location.pathname === '/login' || window.location.pathname === '/register'){}
                    else {
                        window.location.href = '/login';
                        return;
                    }
                }
                const error = new Error("Http error!")
                error.data = await response.json();
                throw error;
            }
            return response.json();
        })
        .catch(error => {
            throw error;
        })
}
export default apiFetch;