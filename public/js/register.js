async function register() {
    let form = document.getElementById("form2"),
        formData = new FormData(form);

    // Debugging: Log formData
    for (let [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }

    try {
        let response = await fetch('http://localhost:8080/api/register', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            let data = await response.json();
            localStorage.setItem('token', data.token);
            console.log("Token saved:", localStorage.getItem('token'));
        } else {
            let errorData = await response.json();
            console.log("Server error:", errorData);
        }
    } catch (error) {
        console.log("Error:", error);
    }

    let errorMessage = document.getElementById("errorMessage"),
        email = document.getElementById("email"),
        password = document.getElementById("password");

    if (email.value === "" || password.value === "") {
        errorMessage.innerHTML = "Please fill in all fields";
        errorMessage.style.color = "red";
    }
}
