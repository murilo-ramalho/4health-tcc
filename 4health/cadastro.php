<?php
//iniciando
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

// validação de cpf
$cpf_valida = $cpf;
function validaCPF($cpf_valida) {
    $cpf_valida = preg_replace( '/[^0-9]/is', '', $cpf_valida);
    if (strlen($cpf_valida) != 11) {
        return false;
    }
    if (preg_match('/(\d)\1{10}/', $cpf_valida)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf_valida[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf_valida[$c] != $d) {
            return false;
        }
    }
    return true;
}

if(validaCPF($cpf_valida) == false){
    echo "<script>window.alert('por favor, insira um CPF valido');window.history.back();</script>";
    exit;
};

// inserindo os dados no sql
$PDO = db_connect();
$sql = "INSERT INTO paciente(cpf, nome, email, senha) VALUES(:cpf, :name, :email, :senha)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);

// verificando se os dados foram cadastrados
if ($stmt->execute())
{
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['name'] = $name;
    header('Location: index.php');
} else {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['name']);
    echo "<script>window.alert('erro ao cadastrar, por favor tente novamente);window.history.back();</script>";
    print_r($stmt->errorInfo());
}

?>