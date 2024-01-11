<?php
    if(isset($_POST['confirmar'])){
        include('lib/conexao.php');
        $id = $_GET['id'];
        $sql_code = "DELETE FROM clientes WHERE id = '$id'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        if($sql_query){ 
            header("location: cliente_excluido.php");
        die();    
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
    <form action="" method="POST">
        <img src="imgs\assustador.png" alt="rosto_assutado">
        <h1>Tem certeza que deseja excluir esse cliente?</h1>
        <button onclick="voltarLista()" class="botaoVoltar3" type="button">Não</button>
        <button class="botaoVoltar3" name="confirmar" value="1" type="submit">Sim</button>
    </form>
    <script src="js\script.js"></script>
</body>
</html>