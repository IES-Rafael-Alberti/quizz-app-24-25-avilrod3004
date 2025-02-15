<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar quiz</title>
</head>
<body>
<?php
require_once '../db/model.php';
require_once '../db/Quiz.php';

if (!isset($_POST["quiz_id"])) {
    die("Error: No se ha proporcionado un ID de quiz.");
}

$quiz_id = $_POST["quiz_id"];

$my_model = Model::getInstance();
$quiz = $my_model->obtener_quiz($quiz_id);
?>

<h1>Quiz - <?= $quiz->getTitle() ?></h1>
<form action="update_quiz.php" method="post">
    <label for="quiz_id"></label>
    <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz->getQuizId() ?>">

    <label for="title">Titulo</label>
    <input type="text" id="title" name="title" value="<?= $quiz->getTitle() ?>">

    <label for="description">Descripción</label>
    <textarea name="description" id="description"  cols="30" rows="5"><?= $quiz->getDescription() ?></textarea>

    <input type="submit" value="Guardar">
</form>

<?php
if (isset($_GET["error"])) {
    echo '<span class="error">' . $_GET["error"] . "</span>";
}
?>

</body>
</html>

