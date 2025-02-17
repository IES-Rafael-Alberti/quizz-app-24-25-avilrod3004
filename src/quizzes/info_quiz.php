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
    <title>Info quiz</title>
</head>
<body class="contenedor">
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

    if (!isset($_POST["quiz_id"])) {
        die("Error: No se ha proporcionado un ID de quiz.");
    }

    $quiz_id = $_POST["quiz_id"];

    $my_model = Model::getInstance();
    $quiz = $my_model->obtener_quiz($quiz_id);
    ?>

    <aside class="lateral">
        <h1 class="lateral__nombre"><?= $quiz->getTitle() ?></h1>
        <p class="lateral__info"><?= $quiz->getDescription() ?></p>

        <form action="edit_quiz.php" method="post">
            <label for="quiz_id"></label>
            <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz_id ?>">

            <input type="submit" value="Editar quiz" class="boton">
        </form>
        <form action="../questions/add_question.php" method="post">
            <label for="quiz_id"></label>
            <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz_id ?>">

            <button type="submit" class="boton">Añadir pregunta</button>
        </form>
    </aside>

    <main class="principal">
        <h1 class="principal__titulo">Preguntas</h1>

        <?php
        require_once '../db/Question.php';

        $my_model = Model::getInstance();
        $array_questions = $my_model->obtener_preguntas_quiz($quiz_id);
        ?>

        <?php
        if (empty($array_questions)) {
            echo "
                    <div class='principal__sin-contenido'>
                        <p class='sin-contenido__texto'>Este quiz no tiene preguntas</p>
                    </div>
                ";
        } else {
            foreach ($array_questions as $question) {
        ?>
        <article class="question">
            <h1 class="question__pregunta"><?= $question->getQuestionText() ?></h1>

            <ol type="a" class="question__listado">
                <li class="listado-question__opcion"><?= $question->getOptionA() ?></li>
                <li class="listado-question__opcion"><?= $question->getOptionB() ?></li>
                <li class="listado-question__opcion"><?= $question->getOptionC() ?></li>
                <li class="listado-question__opcion"><?= $question->getOptionD() ?></li>
            </ol>

            <p class="question__correcta">Respueta correcta: <?= $question->getCorrectOption() ?></p>

            <div class="question__acciones">
                <form action="../questions/edit_question.php" method="post">
                    <label for="question_id"></label>
                    <input type="hidden" id="question_id" name="question_id" value="<?= $question->getQuestionId() ?>">
                    <input type="submit" value="Editar" class="boton__consultar">
                </form>

                <form action="../questions/delete_question.php" method="post">
                    <label for="question_id"></label>
                    <input type="hidden" id="question_id" name="question_id" value="<?= $question->getQuestionId() ?>">
                    <input type="submit" value="Eliminar" class="boton__eliminar">
                </form>
            </div>
        </article>
        <?php
            }
        }
        ?>
    </main>

    <footer class="pie">
        <p>soy el footer</p>
    </footer>
</body>
</html>
