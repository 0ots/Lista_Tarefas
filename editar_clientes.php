<?php
include('lib/conexao.php');
include('lib/mail.php');
include('lib/upload.php');
$id = $_GET['id'];
$sql_clientes = "SELECT * FROM clientes where id = '$id'";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$cliente = $query_clientes->fetch_assoc();
function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
} 
    $nascimento_formatado = "";
    if(!empty($cliente['nascimento'])){
    $nascimento_formatado = date("d/m/Y", strtotime($cliente['nascimento']));
    }  
    if(count($_POST) > 0){
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
            $sql_code = "UPDATE clientes SET nome = '$nome', senha = '$senha', email = '$email', telefone = '$telefone', nascimento = '$nascimento', foto = '$path' where id = '$id'";
            $status = $mysqli->query($sql_code) or die($mysqli->error);
            if($status){
                enviar_email($email, "Sua conta foi atualizada com sucesso!","
                <h1>Parabéns</h1><br>
                <p>
                Sua conta foi atualizada com sucesso!
                </p><br>
                <p>
                <b>Login: $email </b><br>
                <b>Senha: $senha_descriptografada</b>
                </p><br>
                <p>Para acessar o sistema, <a href='http://localhost/projeto'>clique aqui</a></p><br>
                ");
                echo "<p><b>Cliente atualizado com sucesso!<b></p>
                <p><a href='clientes.php'>Voltar para a lista de clientes</a></p>";
                die();
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
    <title>Atualizar Clientes</title>
</head>
<body>
    <a href="clientes.php">Voltar para a lista</a>
    <form enctype="multipart/form-data" action="" method="POST">
        <p>
            <label for="">Nome</label>
            <input class="teste" type="text" name="nome" value="<?php echo $cliente['nome'];?>">
        </p>
        <p>
            <label for="">Senha</label>
            <input class="teste" type="password" name="senha" placeholder="Inserir nova senha" value="">
        </p>
        <p>
            <label for="">E-mail</label>
            <input type="text" name="email" value="<?php echo $cliente['email']?>">
        </p>
        <p>
            <label for="">Telefone</label>
            <input type="text" name="telefone" value="<?php echo $cliente['telefone']?>">
        </p>
        <p>
            <label for="">Data de Nascimento</label>
            <input type="text" name="nascimento" value="<?php echo $nascimento_formatado?>">
        </p>
        <p>
            <label for="">Foto Atual</label>
            <img height="100" src="<?php echo $cliente['foto'];?>" alt="">
        </p>
        <p>
            <label for="">Foto</label>
            <input type="file" name="foto" value="">
        </p>
        <p>
            <button id="botaoCadastrar" type="submit">Atualizar Cliente</button>
        </p>
    </form>
</body>
</html>