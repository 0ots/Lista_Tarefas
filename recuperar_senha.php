<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Oots</title>
</head>
<body>
    <form enctype="multipart/form-data" action="senha_recuperada.php" method="POST">
        <img src="imgs\choro.png" alt="userImage">
        <p id="tituloLogin">
            Esqueceu sua senha?
        </p>
        <div id="divLogin">
            <p>
                <label for="txtNomeLogin"><i class="fas fa-envelope"></i></label>
                <input id="txtNomeLogin" type="text" name="email" value="" placeholder="Insira o e-mail cadastrado em sua conta">
            </p>
            <p>
                <button class="botaoVoltar4" type="submit">Recuperar</button>
                <button onclick="voltarLogin()" class="botaoVoltar4" type="button">Voltar</button>
            </p>
        </div>
    </form>
    <script src="js\scripts.js"></script>
</body>
</html>