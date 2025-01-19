async function login(){
    event.preventDefault();
    let form = document.getElementById('form'),
        formData = new FormData(form);
    const { default: apiFetch } = await import('/js/utils/apiFetch.js');
    await apiFetch('/login',{method:'POST',body:formData})
        .then(data => {
            console.log(data)
            localStorage.setItem('token',data.token)
            window.location.href = '/dashboard';
        })
        .catch((error) => {
                console.error(error.data);
                document.getElementById('error').innerHTML = '';
                Object.keys(error.data.errors).forEach(err => {
                    document.getElementById('error').innerHTML += `<p class="text-red-500 mt-1">${error.data.errors[err]}</p>`;
                })
            });
}