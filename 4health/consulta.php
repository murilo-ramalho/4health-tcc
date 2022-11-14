<?php
if(isset($_POST['submit']) && empty($_POST['medico1'])) {
    echo "<script>window.alert('Por favor escolha um horario para agendar');window.history.back();</script>";
} else {
    require_once 'init.php';
    session_start();
    $PDO = db_connect();

    $crm = $_POST['medico1'];
    $data = date('y-m-d');

    $sql_horario = "SELECT horario FROM medico where crm = :crm";
    $stmt_horario = $PDO->prepare($sql_horario);
    $stmt_horario->bindParam(':crm', $crm);
    $stmt_horario->execute();
    $resultado = $stmt_horario->fetch(PDO::FETCH_ASSOC);
    $hora = $resultado['horario'];

    $hora_atual = date('hh');
    if ($hora_atual > $hora) {
        $nome = $_SESSION['name'];
        $email = $_SESSION['email'];
    
        $sql_paciente = "SELECT * from paciente where nome= :nome and email= :email";
        $stmt_paciente = $PDO->prepare($sql_paciente);
        $stmt_paciente->bindParam(':nome', $nome);
        $stmt_paciente->bindParam(':email', $email);
        $stmt_paciente->execute();
        $paciente = $stmt_paciente->fetch(PDO::FETCH_ASSOC);
        $cpf = $paciente['cpf'];
    
        $sql = "INSERT INTO consulta(cpf_paciente, crm_medico, data, hora) value(:cpf, :crm, :data, :hora)";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':crm', $crm);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':hora', $hora);
    
        if ($stmt->execute()) {
            echo "<script>window.alert('Sua consulta foi registrada');window.history.back();</script>";
        } else {
            echo "<script>window.alert('não foi possivel cadastrar sua consulta, por favor tente novamente');window.history.back();</script>";
        }
    } else {
        echo "<script>window.alert('não foi possivel cadastrar sua consulta devido ao horario ultrapassado, por favor tente novamente amanhã');window.history.back();</script>";
    }
}

?>