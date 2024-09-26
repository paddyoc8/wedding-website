document.getElementById("password-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const enteredPassword = document.getElementById("password").value;
    const correctPassword = "testPassword"; // Replace with your actual password

    if (enteredPassword === correctPassword) {
        window.location.href = "../pages/home.html"; // Redirect to your home page
    } else {
        document.getElementById("error-message").style.display = "block";
    }
});
