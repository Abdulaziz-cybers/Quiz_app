function test(){
    let errorMessage = document.getElementById('forTest'),
        email = document.getElementById('email'),
        password = document.getElementById('password');

    if (email.value === '' || password.value === ''){
        errorMessage.innerText = "email or password is empty";
        errorMessage.style.color = 'red';
    }
}