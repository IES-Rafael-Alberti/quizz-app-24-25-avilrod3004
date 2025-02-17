<?php
require_once '../db/model.php';

session_start();

if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['title']) || !isset($_POST['description'])) {
    $_SESSION["error"] = "Faltan datos para crear el quiz";

    header("Location: new_quiz.php");
    exit();
}

$title = $_POST['title'];
$description = $_POST['description'];
$owner = $_SESSION['id'];

if (empty($title) || empty($description)) {
    $_SESSION["error"] = "El título y la descripción no pueden estar vacíos";
    header("Location: new_quiz.php");
    exit();
}

$resultado = false;
$my_model = Model::getInstance();
$resultado = $my_model->crear_quiz($title, $description, $owner);

if ($resultado) {
    header('Location: ../user/perfil.php');
    exit();
} else {
    $_SESSION["error"] = "No se ha podido crear el quiz";
    header('Location: new_quiz.php');
    exit();
}
