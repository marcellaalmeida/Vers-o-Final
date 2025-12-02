<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $quarto = new Quarto();
    $quarto->setNumero($_POST['numero']);
    $quarto->setPreco_Diaria($_POST['preco_diaria']);
    $quarto->setId($_POST['id']);

    // Construir um objeto do TipoProduto
    $status = new Status();
    $status->setId($_POST['status']);

    // Definir o tipoProduto (objeto da associação) na classe Produto
    $quarto->setStatus($status);

    // Construir um objeto do TipoProduto
    $tipo = new Tipo();
    $tipo->setId($_POST['tipo']);

    // Definir o tipoProduto (objeto da associação) na classe Produto
    $quarto->setTipo($tipo);

    // Inserir no Banco de Dados
    $dao = new QuartoDAO();
    $dao->update($quarto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');