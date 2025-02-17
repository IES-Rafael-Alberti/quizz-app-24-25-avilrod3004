<?php

require_once '../db/model.php';

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST["quiz_id"])) {
    $_SESSION["error"] = "Error: No se ha proporcionado un ID de quiz.";
    header("Location: ../user/perfil.php");
    exit();
}

$quiz_id = $_POST["quiz_id"];

$resultado = false;
$my_model = Model::getInstance();
$resultado = $my_model->borrar_quiz($quiz_id);

if ($resultado) {
    header('Location: ../user/perfil.php');
    exit();
} else {
    $_SESSION["error"] = "No se ha podido borrar el quiz.";
    header('Location: ../user/perfil.php');
    exit();
}
