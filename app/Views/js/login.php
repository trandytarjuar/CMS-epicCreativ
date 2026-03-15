<script>
    document.getElementById("showPassword").addEventListener("change", function() {
        const passwordInput = document.getElementById("password");

        if (this.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });

    const btnLogin = document.getElementById("btnLogin");

    btnLogin.addEventListener("click", loginProcess);

    document.getElementById("password").addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            loginProcess();
        }
    });

    function loginProcess() {
        let email = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        const spinner = document.getElementById("loginSpinner");
        const text = document.getElementById("loginText");
        const alertBox = document.getElementById("loginAlert");

        alertBox.classList.add("d-none");

        spinner.classList.remove("d-none");
        text.innerText = "Loading...";

        fetch("<?= base_url('login') ?>", {

                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },

                body: JSON.stringify({
                    email: email,
                    password: password
                })

            })
            .then(res => res.json())
            .then(data => {

                spinner.classList.add("d-none");
                text.innerText = "Sign In";

                if (data.status === "success") {

                    window.location.href = data.redirect;

                } else {

                    alertBox.innerText = data.message ?? "Username atau password salah";
                    alertBox.classList.remove("d-none");

                }

            })
            .catch(error => {

                spinner.classList.add("d-none");
                text.innerText = "Sign In";

                alertBox.innerText = "Server error";
                alertBox.classList.remove("d-none");

            });

    }
</script>