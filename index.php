<?php

include('lib\conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs\logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Oots</title>
</head>
<body>
    <form enctype="multipart/form-data" action="" method="POST">
        <img src="imgs\user.png" alt="userImage">
        <p id="tituloLogin">
            Login
        </p>
        <div id="divLogin">
            <p>
                <label for="txtNomeLogin"><i class="fas fa-user"></i></label>
                <input id="txtNomeLogin" type="text" name="nome" value="" placeholder="Insira seu usuário">
            </p>
            <p>
            <label for="txtSenhaLogin"><i class="fas fa-lock"></i></label>
            <input id="txtSenhaLogin" type="password" name="senha" value="" placeholder="Insira sua senha" class="password-input">
            <span class="toggle-password" onclick="togglePasswordVisibility()">
                <i id="eyeIcon" class="fas fa-eye"></i>
            </span>
            </p>
            <p>
                <button id="botaoLogar" type="submit">Entrar</button>
            </p>
            <p id="recuperarSenha">
                Não tem uma conta? <a href="criar_usuario.php">Criar conta</a>
            </p>
            <p id="recuperarSenha">
                Esqueceu sua senha? <a href="recuperar_senha.php">Recuperar senha</a>
            </p>
            <p class="icons">
            <a href="" ><i class="fab fa-linkedin"></i></a>
            <a href="https://github.com/0ots" ><i class="fab fa-github"></i></a>
            </p>
        </div>
    </form>
    <script src="js\script.js"></script>
</body>
</html>