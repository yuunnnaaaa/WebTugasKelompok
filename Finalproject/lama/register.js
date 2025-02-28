document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("register-form").addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah reload halaman

        // Ambil data dari form
        let username = document.getElementById("username").value;
        let usia = document.getElementById("usia").value;
        let password = document.getElementById("password").value;
        let password2 = document.getElementById("password2").value;

        // Kirim data ke PHP via Fetch API
        fetch("register.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ username, usia, password, password2 })
        })
        .then(response => response.json()) // Convert response ke JSON
        .then(data => {
            if (data.status === "success") {
                alert(data.message);
                window.location.href = "login.php"; // Redirect ke login
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
