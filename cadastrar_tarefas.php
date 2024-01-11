<?php
$id = $_GET['id']; 
function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}
    if(count($_POST) > 0){
        include('lib/conexao.php');
        include('lib/mail.php');
        $erro = false;
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $vencimento = $_POST['vencimento'];
            $sql_code = "INSERT INTO tasks (title, description, maturity, user_id) VALUES('$titulo', '$descricao', '$vencimento', '$id')";
            $status = $mysqli->query($sql_code) or die($mysqli->error);
            unset($_POST);
            header("location: clientes.php?id=" . $id);
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
        <img src="imgs\lista-de-tarefas.png" alt="userImage">
        <div id="divLogin">
        <p id="cadastrarCliente">
            Nova Tarefa
        </p>    
        <p>
            <label for="txtNomeLogin"><i class="fas fa-user"></i></label>
            <input type="text" name="titulo" placeholder="Insira o título" value="<?php if(isset($_POST['titulo'])) echo $_POST['titulo'];?>">
        </p>
        <p>
            <label for="txtNomeLogin"><i class="fas fa-lock"></i></label>
            <input class="teste" placeholder="Insira a descrição" type="text" name="descricao" value="<?php if(isset($_POST['descricao'])) echo $_POST['descricao'];?>">
        </p>
        <p>
            <label for="txtNomeLogin"><i class="fas fa-calendar"></i></label>
            <input type="date" name="vencimento" placeholder="01/01/1970" title="Insira a data de vencimento da tarefa" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>">
        </p>
        <p>
            <button id="botaoCadastrar" type="submit">Cadastrar</button>
            <button id="botaoNovaTarefa">
            <a class="botaolink" href="clientes.php?id=<?php echo $id ?>">Voltar</a>
            </button>       
        </p>
        </div>
    </form>
    <script src="js\scripts.js"></script>
</body>
</html>