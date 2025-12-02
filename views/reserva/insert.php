<?php
    require "../../autoload.php";

    // Construir o objeto da Reserva
    $reserva = new Reserva();
    $reserva->setData_Checkin($_POST['data_checkin']);
    $reserva->setData_Checkout($_POST['data_checkout']);
    $reserva->setValor_Total($_POST['valor_total']);

    // Construir um objeto do funcionario
    $funcionario = new Funcionario();
    $funcionario->setId($_POST['funcionario']);

    // Definir o funcionario na classe reserva
    $reserva->setFuncionario($funcionario);

    // Construir um objeto do hospede
    $hospede = new Hospede();
    $hospede->setId($_POST['hospede']);

    // Definir o hospede na classe reserva
    $reserva->setHospede($hospede);

    // Construir um objeto do status reserva
    $status_reserva = new StatusReserva();
    $status_reserva->setIdStatusReserva($_POST['status_reserva']);

    // Definir o status reserva na classe reserva
    $reserva->setStatus_Reserva($status_reserva);

    // Inserir no Banco de Dados
    $dao = new ReservaDAO();
    $dao->create($reserva);

    // Redirecionar para o index
    header('Location: index.php');
?>