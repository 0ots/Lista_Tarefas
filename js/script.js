function voltarLogin() {
    location.replace("index.php");
}
function voltarLista() {
    location.replace("clientes.php");
}
function emailRecuperacaoSenha(){
    alert("E-mail enviado com sucesso.");
}
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("txtSenhaLogin");
    var eyeIcon = document.getElementById("eyeIcon");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.className = "fas fa-eye-slash";
    } else {
        passwordInput.type = "password";
        eyeIcon.className = "fas fa-eye";
    }
}