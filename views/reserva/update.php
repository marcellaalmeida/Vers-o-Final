<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $reserva = new Reserva();
    $reserva->setData_Checkin($_POST['data_checkin']);
    $reserva->setData_Checkout($_POST['data_checkout']);
    $reserva->setValor_Total($_POST['valor_total']);
    $reserva->setId($_POST['id']);

    // Construir um objeto do TipoProduto
    $funcionario = new Funcionario();
    $funcionario->setId($_POST['funcionario']);

    // Definir o tipoProduto (objeto da associação) na classe Produto
    $reserva->setFuncionario($funcionario);

    // Construir um objeto do TipoProduto
    $hospede = new Hospede();
    $hospede->setId($_POST['hospede']);

    // Definir o tipoProduto (objeto da associação) na classe Produto
    $reserva->setHospede($hospede);

    // Construir um objeto do TipoProduto
    $status_reserva = new StatusReserva();
    $status_reserva->setIdStatusReserva($_POST['status_reserva']);

    // Definir o tipoProduto (objeto da associação) na classe Produto
    $reserva->setStatus_Reserva($status_reserva);

    // Inserir no Banco de Dados
    $dao = new ReservaDAO();
    $dao->update($reserva);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');