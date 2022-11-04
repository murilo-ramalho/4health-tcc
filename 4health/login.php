<?php
require_once 'init.php';
session_start();

//dados do login
$name2 = isset($_POST['name2']) ? $_POST['name2'] : null;
$email2 = isset($_POST['email2']) ? $_POST['email2'] : null;
$senha2 = isset($_POST['senha2']) ? $_POST['senha2'] : null;

if (empty($email2) || empty($senha2) || empty($name2)){
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    echo "<script>window.alert('Por favor preencha todos os campos');window.history.back();</script>";
    exit;
} else {
    $PDO = db_connect();
    $sql = "SELECT * FROM paciente where nome=:name2 and email=:email2 and senha=:senha2";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':name2', $name2);
    $stmt->bindParam(':email2', $email2);
    $stmt->bindParam(':senha2', $senha2);
    $stmt-> execute();
    $total =  $stmt->rowCount();
    if($total==1){
        $_SESSION['name'] = $name2;
        $_SESSION['email'] = $email2;
        $_SESSION['senha'] = $senha2;
        header('Location: index.php');
        exit();
    }else{
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        echo "<script>window.alert('Erro ao fazer login, por favor tente novamente');window.history.back();</script>";
        exit();
    }
}
?>