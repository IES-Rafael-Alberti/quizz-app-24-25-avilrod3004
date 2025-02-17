<?php

require_once '../db/model.php';

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST["question_id"])) {
    $_SESSION["error"] = "Error: No se ha proporcionado un ID de la pregunta.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$question_id = $_POST["question_id"];

$resultado = false;
$my_model = Model::getInstance();

$resultado = $my_model->borrar_question($question_id);

if (!$resultado) {
    $_SESSION["error"] = "No se ha podido borrar la pregunta.";
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
