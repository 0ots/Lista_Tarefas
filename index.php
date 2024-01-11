<?php

include('lib\conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "oots";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Use instruções preparadas para evitar SQL injection
    $sql_code = "SELECT id FROM user WHERE email = '$email'";
    $result = $conn->query($sql_code);

    if ($result === false) {
        die("Erro na execução da consulta: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usuarioId = $row['id'];

        // Ou redirecionar para a página desejada
        header("Location: tarefas.php?id=" . $usuarioId);
    } else {
        echo "Login inválido.";
    }

    $conn->close();
}

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
                <input id="txtNomeLogin" type="text" name="email" value="" placeholder="Insira seu email">
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
                Não tem uma conta? <a href="criar_usuario.php">Clique aqui</a>
            </p>
            <p id="recuperarSenha">
                Esqueceu sua senha? <a href="recuperar_senha.php">Clique aqui</a>
            </p>
            <p class="icons">
            <a href="" ><i class="fab fa-linkedin"></i></a>
            <a href="https://github.com/0ots" ><i class="fab fa-github"></i></a>
            </p>
        </div>
    </form>
    <script src="js\scripts.js"></script>
</body>
</html>