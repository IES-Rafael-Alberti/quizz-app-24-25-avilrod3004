<?php
require_once "../db/model.php";
$username = $_POST["username"];
$password = $_POST["password"];
$rol = $_POST["rol"];

$resultado=false;
$my_model = Model::getInstance();
if(!$my_model->check_user($username, $password))
    $resultado=$my_model->crea_usuario($username, $password, $rol);

if($resultado) {
    session_start();
    $_SESSION["username"] = $_POST["username"];
    session_write_close();
    header("Location: login.php");
} else {
    header("Location: register.php?error=No se ha podido crear el usuario");
}
