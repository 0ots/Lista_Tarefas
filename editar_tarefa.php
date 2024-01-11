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
        if($erro) {
            echo $erro = "<p><b>$erro</b></p><br>";
        }
        else{
            $senha = password_hash($senha_descriptografada = $_POST['senha'], PASSWORD_DEFAULT);
            $sql_code = "UPDATE clientes SET nome = '$nome', senha = '$senha', email = '$email', telefone = '$telefone', nascimento = '$nascimento', foto = '$path' where id = '$id'";
            $status = $mysqli->query($sql_code) or die($mysqli->error);
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
    <title>Atualizar Clientes</title>
</head>
<body>
    <form enctype="multipart/form-data" action="cliente_editado.php" method="POST">
        <div id="divLogin">
            <p>
                <label for="txtNomeLogin"><i class="fas fa-user"></i></label>
                <input class="teste" type="text" name="nome" value="<?php echo $cliente['nome'];?>">
            </p>
            <p>
                <label for="txtSenhaLogin"><i class="fas fa-lock"></i></label>
                <input class="teste" type="password" name="senha" placeholder="Inserir nova senha" value="">
            </p>
            <p>
                <label for="txtNomeLogin"><i class="fas fa-envelope"></i></label>
                <input type="text" name="email" value="<?php echo $cliente['email']?>">
            </p>
            <p>
                <label for="txtNomeLogin"><i class="fas fa-phone"></i></label>
                <input type="text" name="telefone" value="<?php echo $cliente['telefone']?>">
            </p>
            <p>
                <label for="txtNomeLogin"><i class="fas fa-calendar"></i></label>
                <input type="text" name="nascimento" value="<?php echo $nascimento_formatado?>">
            </p>
            <p>
                <img height="100" src="<?php echo $cliente['foto'];?>" alt="">
            </p>
            <p>
                <label for=""></label>
                <input type="file" name="foto" value="">
            </p>
            <p>
                <button id="botaoCadastrar" type="submit">Atualizar</button>
                <button onclick="voltarLista()" id="botaoCadastrar" type="button">Voltar</button>
            </p>
        </div>
    </form>
    <script src="js\scripts.js"></script>
</body>
</html>