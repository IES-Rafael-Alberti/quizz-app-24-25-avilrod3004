<?php
require_once "../db/model.php";

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST["quiz_id"])) {
    $_SESSION["error"] = "Error: No se ha proporcionado un ID de quiz.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$quiz_id = $_POST["quiz_id"];
$question_text = $_POST['question_text'];
$option_a = $_POST['option_a'];
$option_b = $_POST['option_b'];
$option_c = $_POST['option_c'];
$option_d = $_POST['option_d'];
$correct_option = $_POST['correct_option'];

$resultado = false;
$my_model = Model::getInstance();

$resultado = $my_model->crear_pregunta($quiz_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option);

if (!$resultado) {
    $_SESSION["error"] = "No se ha podido crear la pregunta.";
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();