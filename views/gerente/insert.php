<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $gerente = new Gerente();
    $gerente->setNivel_Acesso($_POST['nivel_acesso']);

    // Construir um objeto do funcionario
    $funcionario = new Funcionario();
    $funcionario->setId($_POST['funcionario']);

    // Definir o funcionario (objeto da associação) na classe gerente
    $gerente->setFuncionario($funcionario);

    // Inserir no Banco de Dados
    $dao = new GerenteDAO();
    $dao->create($gerente);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');