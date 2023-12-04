<?php 
    if(isset($_POST['confirmar'])){
        include('lib/conexao.php');
        $id = $_GET['id'];
        $sql_code = "DELETE FROM clientes WHERE id = '$id'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        if($sql_query){ ?>
            <h4>Cliente deletado com sucesso!</h1>
            <p><a href="clientes.php">Voltar para a lista de clientes</a></p>
        <?php 
        die();    
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Clientes</title>
</head>
<body>
    <h1>Tem certeza que deseja excluir esse cliente?</h1>
    <form action="" method="POST">
        <a href="clientes.php">
            <button type="button" style="margin-right: 10px;">Não</button>
        </a>
        <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
        
</body>
</html>