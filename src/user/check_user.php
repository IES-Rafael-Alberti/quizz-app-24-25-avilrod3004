<?php
session_start(); // Asegurar que la sesión se inicia al principio

require_once "../db/pdo.php";

$username = $_POST["username"];
$password = $_POST["password"];

$statement = $conn->prepare("SELECT * FROM usuarios WHERE username = :username");
$statement->execute(array(":username" => $username));

$resultado = $statement->fetchObject();

if ($resultado && password_verify($password, $resultado->password)) {
    $_SESSION["id"] = $resultado->user_id;
    $_SESSION["username"] = $username;
    $_SESSION["rol"] = $resultado->rol;

    header("Location: /user/perfil.php");
    exit();
} else {
    $_SESSION["error"] = "Usuario y/o clave incorrectos";
    header("Location: login.php");
    exit();
}

