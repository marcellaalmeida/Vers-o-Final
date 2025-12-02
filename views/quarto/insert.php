<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $quarto = new Quarto();
    $quarto->setNumero($_POST['numero']);
    $quarto->setPreco_Diaria($_POST['preco_diaria']);

    // Construir um objeto do funcionario
    $status = new Status();
    $status->setIdStatus($_POST['status']);

    // Definir o funcionario (objeto da associação) na classe gerente
    $quarto->setStatus($status);

    // Construir um objeto do funcionario
    $tipo = new Tipo();
    $tipo->setIdTipo($_POST['tipo']);

    // Definir o funcionario (objeto da associação) na classe gerente
    $quarto->setTipo($tipo);

    // Inserir no Banco de Dados
    $dao = new QuartoDAO();
    $dao->create($quarto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');