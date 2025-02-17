<?php
require_once '../db/model.php';

session_start();
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$title = $_POST['title'];
$description = $_POST['description'];
$owner = $_SESSION['id'];

$resultado = false;
$my_model = Model::getInstance();

$resultado = $my_model->crear_quiz($title, $description, $owner);

if ($resultado) {
    header('Location: ../user/perfil.php');
} else {
    header('Location: new_quiz.php?error=No se ha podido crear el quiz');
}
