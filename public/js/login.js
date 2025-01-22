async function login(){

    let form = document.getElementById("form"),
        formData = new FormData(form);

    fetch('http://localhost:8080/api/login', {
        method: 'POST',
        body: formData
    })
        .then(function (response){

            if (response.ok){
                return response.json();
            }

            return Promise.reject(response);
        })
        .then(function (data){
            localStorage.setItem('token', data.token);
        })
        .catch(function (error){
            console.log(error);
        });

    let errorMessage = document.getElementById("errorMessage"),
        email = document.getElementById("email"),
        password = document.getElementById("password");

    if (email.value === "" || password.value === ""){
        errorMessage.innerHTML = "Please fill in all fields";
        errorMessage.style.color = "red";
    }
}