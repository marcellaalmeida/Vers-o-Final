<?php
    require "../../autoload.php";

    // Excluir do Banco de Dados
    $dao = new ReservaHasQuartoDAO();
    $dao->destroy($_GET['reserva_id_reserva'],$_GET['quarto_idquarto']);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: create.php?id=' . $_GET['reserva_id_reserva']);