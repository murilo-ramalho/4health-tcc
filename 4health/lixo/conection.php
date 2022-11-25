<?php

try{
        $pdo = new PDO("Mysql:dbname=CRU;host=localhost","root","");

} catch(PDOException $e) {
    echo "Erro no banco de dados: " .$e->getMessage();
} catch(Exception $e) {
    echo "Erro indeterminado: " .$e->getMessage();
}

?>

<?php
try {

    $conn = new PDO('mysql:host=localhost;dbname=meuBancoDeDados',
    $username,
    $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    
    echo 'ERROR: ' . $e->getMessage();
}