<?php

$mysqli = null;


function conectarBancoDeDados() {
    if (defined('PHPUNIT_TEST') && PHPUNIT_TEST && class_exists('FakeMysqli')) {
        return new FakeMysqli($GLOBALS['fakeData'] ?? []);
    }
    $hostRemoto = "localhost";
    $usuarioRemoto = "id19689874_marcusabagnale";
    $senhaRemoto = "j<ABO7M/>(J~?lB7";
    $bancoDeDadosRemoto = "id19689874_dbbiblia";

    //mysqli("localhost","id19689874_marcusabagnale","j<ABO7M/>(J~?lB7","id19689874_dbbiblia");

    $hostLocal = "localhost";
    $usuarioLocal = "root";
    $senhaLocal = "";
    $bancoDeDadosLocal = "teste";

    // Desativar exibição de erros
    error_reporting(0);

    // Tentar conexão com o banco de dados remoto
    $mysqli = @new mysqli($hostRemoto, $usuarioRemoto, $senhaRemoto, $bancoDeDadosRemoto);

    if ($mysqli->connect_errno) {
        // Tentar conexão com o banco de dados local
        $mysqli = @new mysqli($hostLocal, $usuarioLocal, $senhaLocal, $bancoDeDadosLocal);

        if ($mysqli->connect_errno) {
            return false;
        }
    }

    // Restaurar configuração de exibição de erros
    error_reporting(E_ALL);

    return $mysqli;
}



function executarConsulta($sql, $campo) {
    // Conectar ao banco de dados
    $mysqli = conectarBancoDeDados();

    if (!$mysqli) {
        return false;
    }

    $result = $mysqli->query($sql);

    if (!$result) {
        echo "Erro na consulta: " . $mysqli->error;
        $mysqli->close();
        return false;
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $valor = $row[$campo];
        $result->free_result();
        return $valor;
    }

    return false;
}

function executarConsultaMultipla($sql) {
    // Conectar ao banco de dados
   global $mysqli;
   $mysqli = conectarBancoDeDados();

   if (!$mysqli) {
    return false;
}

$result = $mysqli->query($sql);

if (!$result) {
    echo "Erro na consulta: " . $mysqli->error;
    $mysqli->close();
    return false;
}

    $rows = array();  // Array para armazenar os resultados

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    $result->free_result();
    return $rows;
}