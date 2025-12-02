<?php
    require "../../autoload.php";

    $dao = new ReservaHasQuartoDAO();
?>

<h2>Tabela de Reservados</h2>
<table class="table table-hover">
    <tr>
        <th>ID da Reserva</th>
        <th>Quarto</th>
        <th>Ações</th>
    </tr>
    <?php foreach($dao->read($_GET['id']) as $reservaHasQuarto) : ?>
        <tr>
            <td><?= $reservaHasQuarto->getReserva()->getId() ?></td>
            <td><?= $reservaHasQuarto->getQuarto() ?></td>
            <td>
                <a class="link link-danger" href="destroy.php?reserva_id_reserva=<?= $_GET['id'] ?>&quarto_idquarto=<?= $reservaHasQuarto->getQuarto()->getId() ?>" title="Excluir">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach ?>

</table>