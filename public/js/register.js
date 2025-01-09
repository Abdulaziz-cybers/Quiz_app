async function register(){
    let form = document.getElementById('form_'),
        formData = new FormData(form);

    fetch('http://localhost:80/api/register', {
        method: 'POST',
        body: formData
    })
        .then(function(response){
            if (response.ok) {
                return response.json();
            }

            return Promise.reject(response);
        })
        .then(function(data){
            localStorage.setItem('token', data.token);
            console.log(localStorage.getItem('token'));
        })
        .catch(function(error){
            console.error(error)
        });
}