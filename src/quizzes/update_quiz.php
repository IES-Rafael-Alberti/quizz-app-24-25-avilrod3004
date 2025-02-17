<?php

require_once '../db/model.php';

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
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
} else {
    header('Location: ../user/perfil.php?error=No se ha podido actualizar el quiz');
}
