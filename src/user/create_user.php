<?php
session_start();

require_once "../db/model.php";

$username = $_POST["username"];
$password = $_POST["password"];
$rol = $_POST["rol"];

$resultado=false;
$my_model = Model::getInstance();
if(!$my_model->check_user($username, $password))
    $resultado=$my_model->crea_usuario($username, $password, $rol);

if($resultado) {
    $_SESSION["username"] = $_POST["username"];

    header("Location: login.php");
    exit();
} else {
    $_SESSION["error"] = "No se ha podido crear el usuario";

    header("Location: register.php");
    exit();
}
