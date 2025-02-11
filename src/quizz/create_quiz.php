<?php
require_once '../db/model.php';
$title = $_POST['title'];
$description = $_POST['description'];

$resultado = false;
$my_model = Model::getInstance();

$resultado = $my_model->crear_quiz($title, $description);

if ($resultado) {
    header('Location: ../user/perfil.php');
} else {
    header('Location: new_quiz.php?error=No se ha podido crear el quiz');
}
