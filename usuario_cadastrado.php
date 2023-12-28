<?php 
    include('lib/conexao.php');
    include('lib/mail.php');
    if (isset($_GET['email'])) {
        $email = urldecode($_GET['email']);    
    } else {
        $email = "default";
    }
?>
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
    <form enctype="multipart/form-data" action="" method="POST">
        <img src="imgs\sucesso.png" alt="userImage">
        <p id="tituloLogin">
            Parabéns!
        </p>
        <div id="divLogin">
            <p>
                Sua conta foi criada com sucesso.
            </p>
            <p>
                Enviamos um e-mail para <br><?php echo $email?><br>com as instruções de logon em nossa plataforma.
            </p>
            <p>
                <button onclick="voltarLista()" class="botaoVoltar3" type="button">Voltar</button>
            </p>
        </div>
    </form>
    <script src="js\scripts.js"></script>
</body>
</html>