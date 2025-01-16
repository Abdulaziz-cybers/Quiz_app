async function register(){
    event.preventDefault();
    let form = document.getElementById('form_'),
        formData = new FormData(form);
    const { default: apiFetch } = await import('./utils/apiFetch.js');
    await apiFetch('/register',{method:'POST',body:formData})
        .then(data => {
            console.log(data)
            localStorage.setItem('token',data.token)
            window.location.href = '/dashboard';
        })
        .catch((error) => {
            console.error(error.data.errors);
            document.getElementById('error').innerHTML = '';
            Object.keys(error.data.errors).forEach(err => {
                document.getElementById('error').innerHTML += `<p class="text-red-500 mt-1">${error.data.errors[err]}</p>`;
            })
        });
}