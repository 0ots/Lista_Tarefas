<?php
include('lib/conexao.php');
$sql_clientes = "SELECT * FROM clientes";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <p>Estes são os clientes cadastrados em seu sistema:</p>
    <table class="tabela">
        <thead>
            <th class="cabeca">
                Id:
            </th>
            <th class="cabeca">
                Imagem:
            </th>
            <th class="cabeca">
                Nome:
            </th>
            <th class="cabeca">
                E-mail:
            </th>
            <th class="cabeca">
                Telefone:
            </th>
            <th class="cabeca">
                Nascimento:
            </th>

            <th class="cabeca">
                Data:
            </th>
            <th class="cabeca">
                Ações
            </th>
        </thead>
        <tbody>
            <?php
                if($num_clientes == 0){ ?>
                <tr>
                    <td colspan="7">Nenhum cliente foi cadatrado</td>
                </tr>
                <?php } else {
                    while($cliente = $query_clientes->fetch_assoc()){
                        $telefone_formatado = "Não informado";
                        $nascimento_formatado = "Não informado";
                        if(!empty($cliente['telefone'])){
                            $ddd = substr($cliente['telefone'], 0, 2);
                            $parte1 = substr($cliente['telefone'], 2, 1);
                            $parte2 = substr($cliente['telefone'], 2, 5);
                            $parte3 = substr($cliente['telefone'], 7);
                            $telefone_formatado = "($ddd) $parte1 $parte2-$parte3";
                        }
                        if(!empty($cliente['nascimento'])){
                            $nascimento_formatado = date("d/m/Y", strtotime($cliente['nascimento']));
                        }   
                ?>
            <tr>
                <td class="dado"><?php echo $cliente['id'];?></td>
                <td class="dado"><img height="60px" src="<?php echo $cliente['foto']?>"></td>
                <td class="dado"><?php echo $cliente['nome'];?></td>
                <td class="dado"><?php echo $cliente['email'];?></td>
                <td class="dado"><?php echo $telefone_formatado;?></td>
                <td class="dado""><?php echo $nascimento_formatado;?></td>
                <td class="dado"><?php echo $cliente['data'];?></td>
                <td class="dado">
                    <a class="links" href="editar_clientes.php?id=<?php echo $cliente['id']?>">Editar</a>
                    <a class="links" href="excluir_clientes.php?id=<?php echo $cliente['id']?>">Deletar</a>
                </td>
            </tr>
            <?php 
            }
        } ?>
        </tbody>
    </table>
</body>
</html>