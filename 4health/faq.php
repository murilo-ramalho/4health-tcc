<?php

if(isset($_POST['submit']) || empty($_POST['faq'])) {
    echo "<script>window.alert('Por favor preencha todos os campos');window.history.back();</script>";
} else {
    require_once 'init.php';
    $PDO = db_connect();
    session_start();

    $name = $_SESSION['name'];
    //$name = isset($_POST['name2']) ? $_POST['name2'] : null;
    $faq = isset($_POST['faq']) ? $_POST['faq'] : null;

    $sql = "INSERT INTO faq(nome, ct) VALUES(:name, :faq)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':faq', $faq);

    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        unset($_SESSION['name']);
        echo "<script>window.alert('erro ao adicionar, por favor tente de novo);window.history.back();</script>";
        print_r($stmt->errorInfo());
    }
}

?>