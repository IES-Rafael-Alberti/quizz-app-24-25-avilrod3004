<?php

require_once '../db/model.php';

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST["quiz_id"]) || !isset($_POST["title"]) || !isset($_POST["description"])) {
    $_SESSION["error"] = "Error: Faltan datos para actualizar el quiz.";
    header("Location: ../user/perfil.php");
    exit();
}

$quiz_id = $_POST["quiz_id"];
$title = $_POST["title"];
$description = $_POST["description"];
$owner = $_SESSION["id"];

$resultado = false;
$my_model = Model::getInstance();
$resultado = $my_model->update_quiz($quiz_id, $title, $description, $owner);

if ($resultado) {
    header('Location: ../user/perfil.php');
    exit();
} else {
    $_SESSION["error"] = "No se ha podido actualizar el quiz.";
    header('Location: ../user/perfil.php');
    exit();
}