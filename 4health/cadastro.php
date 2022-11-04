<?php
require_once 'init.php';
session_start();

// pega os dados do formuário
$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;
 
// validação (bem simples, só pra evitar dados vazios)
if (empty($name) || empty($email) || empty($cpf) || empty($senha))
{
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['name']);
    echo "<script>window.alert('Por favor preencha todos os campos');window.history.back();</script>";
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO paciente(cpf, nome, email, senha) VALUES(:cpf, :name, :email, :senha)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);

if ($stmt->execute())
{
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['name'] = $name;
    header('Location: index.php');
}
else
{
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['name']);
    echo "<script>window.alert('erro ao cadastrar, por favor tente novamente);window.history.back();</script>";
    print_r($stmt->errorInfo());
}