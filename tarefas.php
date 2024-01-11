<?php
include('lib/conexao.php');
$id = $_GET['id'];
$sql_tasks = "SELECT * FROM tasks where user_id = $id";
$query_tasks = $mysqli->query($sql_tasks) or die($mysqli->error);
$num_tasks = $query_tasks->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1 id="tituloTarefas">Lista de Tarefas</h1><br>
    <div class="novaTarefa">
        <button id="botaoNovaTarefa">
            <a class="botaolink" href="cadastrar_tarefas.php?id=<?php echo $id ?>">Adicionar</a>
        </button>
    </div>
    <table class="tabela">
        <thead>
            <th class="cabeca">
                Título:
            </th>
            <th class="cabeca">
                Descrição:
            </th>
            <th class="cabeca">
                Vencimento:
            </th>
            <th class="cabeca">
                Ações:
            </th>
        </thead>
        <tbody>
            <?php
                if($num_tasks == 0){ ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Nenhuma tarefa cadastrada</td>
                </tr>
                <?php } else {
                    while($tasks = $query_tasks->fetch_assoc()){
                        if($tasks['maturity']){
                            $vencimento = explode('-', $tasks['maturity']);
                            $vencimento_formatado = implode('/', array_reverse($vencimento));
                        }
                ?>
            <tr>
                <td class="dado"><?php echo $tasks['title'];?></td>
                <td class="dado"><?php echo $tasks['description'];?></td>
                <td class="dado"><?php echo $vencimento_formatado;?></td>
                <td class="dado">
                    <a class="links" href="editar_clientes.php?id=<?php echo $tasks['id']?>">Editar</a>
                    <a class="links" href="excluir_clientes.php?id=<?php echo $tasks['id']?>">Deletar</a>
                </td>
            </tr>
            <?php 
            }
        } ?>
        </tbody>
    </table>
    <script src="js\scripts.js"></script>
</body>
</html>