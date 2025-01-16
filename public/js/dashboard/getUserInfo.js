async function user(){
    const {default: apiFetch} = await import('../utils/apiFetch.js');
    await apiFetch('/user/getInfo',{method:'GET'})
        .then((user) => {
            document.getElementById('userName').innerHTML = user.data.full_name;
        })
        .catch(console.error)
}
user()