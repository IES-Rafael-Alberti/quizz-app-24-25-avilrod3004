<?php
$servidor="db";
$usuario="root";
$clave="pestillo";
$bd="quizzes";

try {

    $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    $conn=new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8",$usuario,$clave,$options);
} catch(PDOException $e) {
    echo "Error de conexión" . $e->getMessage();
}
