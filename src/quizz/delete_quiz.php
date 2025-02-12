<?php

require_once '../db/model.php';

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

if (!isset($_POST["quiz_id"])) {
    die("Error: No se ha proporcionado un ID de quiz.");
}

$quiz_id = $_POST["quiz_id"];

$resultado = false;
$my_model = Model::getInstance();

$resultado = $my_model->borrar_quiz($quiz_id);

if ($resultado) {
    header('Location: ../user/perfil.php');
} else {
    header('Location: ../user/perfil.php?error=No se ha podido borrar el quiz');
}
