<?php 
    include('lib/conexao.php');
    include('lib/mail.php');
    if(count($_POST) > 0){
    $email = $_POST['email'];
    $sql_code = "SELECT id FROM user where email = '$email'";
    $status = $mysqli->query($sql_code) or die($mysqli->error);
            if($status->num_rows > 0){
                enviar_email($email, "Recuperação de senha","
                <h1>Recuperação de senha</h1><br>
                <p>
                Prezado,
                </p>
                <p>
                Uma solicitação de recuperação de senha foi realizada em nome de seu usuário.
                </p>
                <p>
                Para recuperar sua senha, entre em contato com o administrador.
                </p>
                <p>
                Caso desconheça essa solicitação, pedimos que apenas ignore esta mensagem.
                </p>
                ");
                unset($_POST);?>
                <!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="css/style.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                    <title>Oots</title>
                </head>
                <body>
                    <form enctype="multipart/form-data" action="" method="">
                        <img src="imgs\risonho.png" alt="userImage">
                        <p id="tituloLogin">
                            Sucesso!<br>
                        </p>
                        <p>
                            Enviamos um e-mail com informações para recuperação de sua senha.
                        </p>
                        <div id="divLogin">
                            <p>
                                <button onclick="voltarLogin()" class="botaoVoltar5" type="button">Voltar</button>
                            </p>
                        </div>
                    </form>
                    <script src="js\script.js"></script>
                </body>
                </html>
            <?php 
            die();  
        }
            else {
                ?> 
                    <!DOCTYPE html>
                    <html lang="pt-br">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="css/style.css">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                        <title>Oots</title>
                    </head>
                    <body>
                        <form enctype="multipart/form-data" action="" method="">
                            <img src="imgs\risonho.png" alt="userImage">
                            <p id="tituloLogin">
                                Aviso!<br>
                            </p>
                            <p>
                                Não encontramos uma conta vinculada ao endereço de e-mail fornecido.
                            </p>
                            <div id="divLogin">
                                <p>
                                    <button onclick="voltarLogin()" class="botaoVoltar5" type="button">Voltar</button>
                                </p>
                            </div>
                        </form>
                        <script src="js\script.js"></script>
                    </body>
                    </html>
                <?php 
                die();  
            }
        }
?>