<?php
require "../../autoload.php";

// Construir o objeto da ReservaHasQuarto
$reservaHasQuarto = new ReservaHasQuarto();

// Construir um objeto da Reserva
$reserva = new Reserva();
$reserva->setId($_POST['reserva_id_reserva']);  // PEGUE DA VARIÁVEL DIRETAMENTE

// Construir um objeto do Quarto  
$quarto = new Quarto();
$quarto->setId($_POST['quarto_idquarto']);

// Definir o compra e Produto (objetos das associações) na classe CompraProduto
$reservaHasQuarto->setReserva($reserva);
$reservaHasQuarto->setQuarto($quarto);

// Inserir no Banco de Dados
$dao = new ReservaHasQuartoDAO();
$dao->create($reservaHasQuarto);

// Redirecionar para o index
header('Location: create.php?id=' . $reserva->getId());