<script>
    document.getElementById("showPassword").addEventListener("change", function() {
        const passwordInput = document.getElementById("loginPassword");

        if (this.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
</script>