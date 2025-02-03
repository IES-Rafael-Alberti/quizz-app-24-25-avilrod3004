<?php
require_once "../db/pdo.php";

$username = $_POST["username"];
$password = $_POST["password"];

$statement = $conn->prepare("SELECT username, password FROM usuarios WHERE username = :username");
$statement->execute(array(":username" => $username));

$resultado = $statement->fetchObject();
$veri=password_verify($password, $resultado->password);

if ($veri) {
    session_start();
    $_SESSION["username"] = $_POST["username"];
    session_write_close();
    header("Location: /user/perfil.php");
} else {
    header("Location: login.php?error=Usuario y/o clave incorrectos");
}
