<?php

require_once 'init.php';
session_start();
$nome = $_SESSION['name'];

$PDO = db_connect();
$sql = "DELETE FROM paciente WHERE nome = :nome";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome, PDO::PARAM_INT);
if ($stmt->execute())
{
    header('Location: index.php');
    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['name']);
}
else
{
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}

?>