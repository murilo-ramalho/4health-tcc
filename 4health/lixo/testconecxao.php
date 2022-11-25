<?php
$pdo = new PDO('mysql:bdname=4health, host=localhost','root','');
$sql = $pdo->query('SELECT * FROM 4health.pacientes');

$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
?>