<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=../css/reset.css>
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <title>Editar pregunta</title>
</head>
<body class="contenedor-formulario">
    <header class="encabezado">
        <img src="../img/quizzes!.png" alt="Quizzes App" class="encabezado__logo">
        <nav class="encabezado__navegacion">
            <ul class="navegacion__listado">
                <li class="listado__opcion"><a href="../user/logout.php" class="opcion__enlace">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <?php
    require_once '../db/model.php';
    require_once '../db/Question.php';

    if (!isset($_POST["question_id"])) {
        die("Error: No se ha proporcionado un ID de la pregunta.");
    }

    $question_id = $_POST["question_id"];

    $my_model = Model::getInstance();
    $question = $my_model->obtener_pregunta($question_id);
    ?>

    <main class="principal-formulario">
        <h1 class="principal__titulo">Editar pregunta: <?= $question->getQuestionText() ?></h1>
        <form action="update_question.php" method="post" class="principal-formulario__formulario">
            <label for="question_id"></label>
            <input type="text" name="question_id" id="question_id" hidden="hidden" value="<?= $question->getQuestionId() ?>">

            <label for="question_text">Pregunta</label>
            <input type="text" id="question_text" name="question_text" value="<?= $question->getQuestionText() ?>">

            <label for="option_a">Opción A</label>
            <input type="text" id="option_a" name="option_a" value="<?= $question->getOptionA() ?>">

            <label for="option_b">Opción B</label>
            <input type="text" id="option_b" name="option_b" value="<?= $question->getOptionB() ?>">

            <label for="option_c">Opción C</label>
            <input type="text" id="option_c" name="option_c" value="<?= $question->getOptionC() ?>">

            <label for="option_d">Opción D</label>
            <input type="text" id="option_d" name="option_d" value="<?= $question->getOptionD() ?>">

            <label for="correct_option">Opción correcta</label>
            <select name="correct_option" id="correct_option" class="formulario__correct_option">
                <option value="a" <?= $question->getCorrectOption() === 'a' ? 'selected' : '' ?>>A</option>
                <option value="b" <?= $question->getCorrectOption() === 'b' ? 'selected' : '' ?>>B</option>
                <option value="c" <?= $question->getCorrectOption() === 'c' ? 'selected' : '' ?>>C</option>
                <option value="d" <?= $question->getCorrectOption() === 'd' ? 'selected' : '' ?>>D</option>
            </select>

            <button type="submit" class="boton">Actualizar quiz</button>
        </form>

        <?php
        if (isset($_GET["error"])) {
            echo '<span class="error">' . $_GET["error"] . "</span>";
        }
        ?>
    </main>

    <footer class="pie">
        <p>soy el footer</p>
    </footer>
</body>
</html>
