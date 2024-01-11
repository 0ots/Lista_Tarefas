<?php 
function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}
    if(count($_POST) > 0){
        include('lib/conexao.php');
        include('lib/mail.php');
        $erro = "";
        $nome = $_POST['nome'];
        $senha_descriptografada = $_POST['senha'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];
        if(empty($nome)){
            $erro .= "Insira um nome de usuário <br>";
        }
        if(strlen($senha_descriptografada < 6 && $senha_descriptografada) > 16){
            $erro .= "A senha deve ter conter entre 6 e 16 caracteres <br>";
        }
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro .= "Insira um e-mail válido <br>";
        }
        if(!empty($nascimento)){
            $pedacos = explode('/', $nascimento);
            $nascimento = implode('-', array_reverse($pedacos));
        }
        if(empty($telefone)){
            $erro .= "Insira um telefone <br>";
        }
        if(!empty($telefone)) {
            $telefone = limpar_texto($telefone);
            if(strlen($telefone) != 11){
                $erro .= "O telefone deve ser preenchido no padrão 11 11111-1111 <br>";
            }
        }
        if(!empty($erro)) {
            $erro =  "<b>$erro</b>";
        }
        else{
            $senha = password_hash($senha_descriptografada = $_POST['senha'], PASSWORD_DEFAULT);
            $sql_code = "INSERT INTO user (name, senha, email, telefone, birth) VALUES('$nome', '$senha', '$email', '$telefone', '$nascimento')";
            $status = $mysqli->query($sql_code) or die($mysqli->error);
            if($status){
                enviar_email($email, "Sua conta foi criada com sucesso!","
                <h1 style='color: #008000; text-align: center;'>Parabéns</h1><br>
                <p>
                Sua conta foi criada com sucesso!
                </p><br>
                <p>
                <b>Usuário: $email </b><br>
                <b>Senha: $senha_descriptografada</b>
                </p><br>
                <p>Para acessar o sistema, <a href='http://localhost/projeto'>clique aqui</ap><br>
                ");
                unset($_POST);
                header('location: usuario_criado.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Criar Conta</title>
</head>
<body>
    <div class="msgErro">
        <p>
            <?php
                if(!empty($erro)) { ?>
                    <?php echo $erro;
                }
            ?>
        </p>
    </div>
    <form enctype="multipart/form-data" action="" method="POST">
        <img src="imgs\user.png" alt="userImage">
        <p id="tituloLogin">
            Criar Conta
        </p>
        <div id="divLogin">
            <p>
                <label for="txtNomeLogin"><i class="fas fa-user"></i></label>
                <input id="txtNomeLogin" type="text" name="nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" placeholder="Insira seu usuário">
            </p>
            <p>
                <label for="txtSenhaLogin"><i class="fas fa-lock"></i></label>
                <input id="txtSenhaLogin" type="password" name="senha" value="<?php if(isset($_POST['senha'])) echo $_POST['senha'];?>" placeholder="Insira sua senha">
            </p>
            <p>
                <label for="txtSenhaLogin"><i class="fas fa-envelope"></i></label>
                <input id="txtSenhaLogin" type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" placeholder="Insira seu e-mail">
            </p>
            <p>
                <label for="txtSenhaLogin"><i class="fas fa-phone"></i></label>
                <input id="txtSenhaLogin" type="text" name="telefone" value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>" placeholder="Insira seu telefone">
            </p>
            <p>
                <label for="txtSenhaLogin"><i class="fas fa-calendar"></i></label>
                <input id="txtSenhaLogin" type="date" name="nascimento" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>" placeholder="Insira sua data de nascimento" title="Insira sua data de nascimento">
            </p>
            <p>
                <button id="botaoLogar" type="submit">Criar</button>
                <button onclick="voltarLogin()" id="botaoLogar" type="button">Voltar</button>
            </p>
        </div>
    </form>
    <script src="js\scripts.js"></script>
</body>
</html>