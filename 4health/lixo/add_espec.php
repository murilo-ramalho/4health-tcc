<?php
if (isset($_POST['submit']) && empty($_POST['espec'])) {
    echo "<script>window.alert('Por favor preencha corretamente');window.history.back();</script>";
} else {
    require_once 'init.php';
    $PDO = db_connect();
    $user = $;
    $sql = "UPDATE paciente SET especialidade = :espec where cpf = $user[cpf]";
    $espec = isset($_POST['espec']); //? $_POST['espec'] : null;
    $user->bindParam(':espec', $espec);
    if($user->execute()) {
        echo "<script>window.alert('A Especialidade foi adicionada');window.history.back();</script>";
    };
};
?>
