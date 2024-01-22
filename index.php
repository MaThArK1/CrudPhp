<?php

require_once('conexao.php');

if (isset($_GET['excluir'])) {
    $id = filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_NUMBER_INT);

    if($id) {
        $con->exec('DELETE FROm metas WHERE id=' . $id);

      header('Location: index.php');
      exit;
    }
}

$results = $con->query('select * from metas')->fetchAll();

$arraySituacao = [1 => 'Aberta', 2=> 'Em andamento', 3=> 'Realizada'];

include_once('layout/_header.php');

?>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Minhas metas</h5>
        <a class="btn btn-success" href="cadastro.php">Adicionar</a>
    </div>
    <div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($results as $item): ?>
                        <tr>
                            <td><?= $item['descricao']?></td>
                            <td><?= $arraySituacao[$item['situacao']]?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="cadastro.php?id=<?= $item['id']?>">Editar</a>
                                <button class="btn btn-sm btn-danger" onclick="excluir(<?= $item['id'] ?>)">Excluir</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function excluir(id){ 
        if (confirm("Deseja excluir esta meta?")) {
            window.location.href = "index.php?excluir=" + id;
        }
    }
</script>

<?php
include_once('layout/_footer.php');
?>