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
    <title>Quiz</title>
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
    require_once '../db/Quiz.php';
    require_once "../db/Question.php";

    if (!isset($_POST["quiz_id"])) {
        $_SESSION["error"] = "Error: No se ha proporcionado un ID de quiz.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $quiz_id = $_POST["quiz_id"];

    $my_model = Model::getInstance();
    $quiz = $my_model->obtener_quiz($quiz_id);
    $array_questions = $my_model->obtener_preguntas_quiz($quiz_id);
    ?>

    <main class="principal-formulario">
        <form action="./resultado_quiz.php" method="post">
            <h1><?= $quiz->getTitle() ?></h1>
            <p><?= $quiz->getDescription() ?></p>

            <label for="quiz_id"></label>
            <input type="text" name="quiz_id" id="quiz_id" hidden="hidden" value="<?= $quiz->getQuizId() ?>">

            <?php
            foreach ($array_questions as $question) {
            ?>
                <fieldset>
                    <legend><?= $question->getQuestionText() ?></legend>
                    <label for="<?= $question->getQuestionId() ?>">
                        <input type="radio" name="<?= $question->getQuestionId() ?>" value="a"> <?= $question->getOptionA() ?>
                    </label>
                    <label for="<?= $question->getQuestionId() ?>">
                        <input type="radio" name="<?= $question->getQuestionId() ?>" value="b"> <?= $question->getOptionB() ?>
                    </label>
                    <label for="<?= $question->getQuestionId() ?>">
                        <input type="radio" name="<?= $question->getQuestionId() ?>" value="c"> <?= $question->getOptionC() ?>
                    </label>
                    <label for="<?= $question->getQuestionId() ?>">
                        <input type="radio" name="<?= $question->getQuestionId() ?>" value="d"> <?= $question->getOptionD() ?>
                    </label>
                </fieldset>
            <?php
            }
            ?>

            <button type="submit">Terminar</button>
        </form>

        <?php
        if (isset($_SESSION["error"])) {
            echo '<p class="error">' . $_SESSION["error"] . "</p>";
            unset($_SESSION["error"]);
        }
        ?>
    </main>

    <footer class="pie">
        <p>soy el footer</p>
    </footer>
</body>
</html>
