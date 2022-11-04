<?php
if(isset($_POST['submit']) && empty($_POST['medico1'])) {
    echo "<script>window.alert('Por favor escolha um horario para agendar');window.history.back();</script>";
} else {
    echo "<script>window.alert('sua consulta foi agendada');window.history.back();</script>";
    /*require_once 'init.php';
    session_start();
    $PDO = db_connect();
    $dataC = date('Y-m-d');
    $nome = $_SESSION['nome'];
    $senha = $_SESSION['senha'];
    $sql_p = "SELECT * from paciente where nome=:nome and senha=:senha";
    $stmt_p = bindParam(':nome', $nome);
    $sql = "INSERT INTO consulta(,cpf_paciente) value(:dataC, :sql_p)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':dataC', $dataC);
    if ($stmt->execute()) {
        echo "<script>window.alert('Sua consulta foi registrada);window.history.back();</script>";
    } else {
        echo "<script>window.alert('não foi possivel cadastrar sua consulta, por favor tente novamente);window.history.back();</script>";
    }*/
}

?>