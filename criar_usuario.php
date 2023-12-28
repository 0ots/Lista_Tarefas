<?php 
function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}
    if(count($_POST) > 0){
        include('lib/conexao.php');
        include('lib/mail.php');
        $erro = false;
        $nome = $_POST['nome'];
        $senha_descriptografada = $_POST['senha'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];
        if(empty($nome)){
            $erro = "Preencha o nome.";
        }
        if(strlen($senha_descriptografada < 6 && $senha_descriptografada) > 16){
            $erro = "A senha deve ter conter entre 6 e 16 caracteres";
        }
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = "Preencha um e-mail válido.";
        }
        if(!empty($nascimento)){
            $pedacos = explode('/', $nascimento);
            if (count($pedacos) == 3){
                $nascimento = implode('-', array_reverse($pedacos));
            } else {
                echo "A data de nascimento deve seguir o padrão dia/mes/ano";
            }
        }
        if(!empty($telefone)) {
            $telefone = limpar_texto($telefone);
            if(strlen($telefone) != 11){
                $erro = "O telefone deve ser preenchido no padrão 11 11111-1111";
            }
        }
        if($erro) {
            echo $erro = "<p><b>$erro</b></p><br>";
        }
        else{
            $senha = password_hash($senha_descriptografada = $_POST['senha'], PASSWORD_DEFAULT);
            $sql_code = "INSERT INTO user (name, password, email, telefone, birth) VALUES('$nome', '$senha', '$email', '$telefone', '$nascimento')";
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
                header("location: usuario_cadastrado.php?email=$email");
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
                <input id="txtSenhaLogin" type="date" name="nascimento" value="" placeholder="Insira sua data de nascimento" title="Insira sua data de nascimento">
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