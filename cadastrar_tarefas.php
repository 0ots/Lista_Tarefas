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
        if($erro) {
            echo $erro = "<p><b>$erro</b></p><br>";
        }
        else{
            $senha = password_hash($senha_descriptografada = $_POST['senha'], PASSWORD_DEFAULT);
            $sql_code = "INSERT INTO clientes (nome, senha, email, telefone, nascimento, data, foto) VALUES('$nome', '$senha', '$email', '$telefone', '$nascimento', NOW(), '$path')";
            $status = $mysqli->query($sql_code) or die($mysqli->error);
            if($status){
                unset($_POST);
                header("location: cliente_cadastrado.php?email=$email");
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
    <title>Oots</title>
</head>
<body>
    <form enctype="multipart/form-data" action="" method="POST">
        <div id="divLogin">
        <p id="cadastrarCliente">
            Nova Tarefa
        </p>    
        <p>
            <label for="txtNomeLogin"><i class="fas fa-user"></i></label>
            <input type="text" name="nome" placeholder="Insira o título" value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>">
        </p>
        <p>
            <label for="txtNomeLogin"><i class="fas fa-lock"></i></label>
            <input class="teste" placeholder="Insira a descrição" type="text" name="senha" value="<?php if(isset($_POST['senha'])) echo $_POST['senha'];?>">
        </p>
        <p>
            <label for="txtNomeLogin"><i class="fas fa-calendar"></i></label>
            <input type="text" name="nascimento" placeholder="01/01/1970" title="Insira a data de vencimento da tarefa" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>">
        </p>
        <p>
            <button id="botaoCadastrar" type="submit">Cadastrar</button>
            <button id="botaoVoltar1" type="button" onclick="voltar()">Voltar</button>           
        </p>
        </div>
    </form>
    <script src="js\scripts.js"></script>
</body>
</html>