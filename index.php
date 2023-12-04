<?php 
function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}
    if(count($_POST) > 0){
        include('lib/conexao.php');
        include('lib/mail.php');
        include('lib/upload.php');
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
        $path = "";
        if(isset($_FILES['foto'])){
            $arquivo = $_FILES['foto'];
            $path = enviarArquivo($arquivo['error'], $arquivo['size'],$arquivo['name'], $arquivo['tmp_name']);
            if($path == false){
                $erro = "Falha ao enviar arquivo. Tente novamente.";
            }
        }
        if($erro) {
            echo $erro = "<p><b>$erro</b></p><br>";
        }
        else{
            $senha = password_hash($senha_descriptografada = $_POST['senha'], PASSWORD_DEFAULT);
            $sql_code = "INSERT INTO clientes (nome, senha, email, telefone, nascimento, data, foto) VALUES('$nome', '$senha', '$email', '$telefone', '$nascimento', NOW(), '$path')";
            $status = $mysqli->query($sql_code) or die($mysqli->error);
            if($status){
                enviar_email($email, "Sua conta foi criada com sucesso!","
                <h1>Parabéns</h1><br>
                <p>
                Sua conta foi criada com sucesso!
                </p><br>
                <p>
                <b>Login: $email </b><br>
                <b>Senha: $senha_descriptografada</b>
                </p><br>
                <p>Para acessar o sistema, <a href='http://localhost/projeto'>clique aqui</a></p><br>
                ");
                echo "<p><b>Cliente cadastrado com sucesso!<b></p>";
                unset($_POST);
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
    <title>Cadastrar Clientes</title>
</head>
<body>
    <a href="clientes.php">Voltar para a lista</a>
    <form enctype="multipart/form-data" action="" method="POST">
        <p>
            <label for="">Nome</label>
            <input class="teste" type="text" name="nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>">
        </p>
        <p>
            <label for="">Senha</label>
            <input class="teste" type="password" name="senha" value="<?php if(isset($_POST['senha'])) echo $_POST['senha'];?>">
        </p>
        <p>
            <label for="">E-mail</label>
            <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
        </p>
        <p>
            <label for="">Telefone</label>
            <input placeholder="12 12345-1234" type="text" name="telefone" value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>">
        </p>
        <p>
            <label for="">Data de Nascimento</label>
            <input type="text" name="nascimento" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>">
        </p>
        <p>
            <label for="">Foto</label>
            <input type="file" name="foto" value="<?php if(isset($_POST['foto'])) echo $_POST['foto'];?>">
        </p>
        <p>
            <button id="botaoCadastrar" type="submit">Salvar Cliente</button>
        </p>
    </form>
</body>
</html>