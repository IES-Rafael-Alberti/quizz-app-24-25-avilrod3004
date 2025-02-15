<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <title>Info quiz</title>
</head>
<body class="contenedor">
    <header class="encabezado">
        <h1 class="encabezado__titulo">Quizzes App</h1>

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
        <h1>Quiz - <?= $quiz->getTitle() ?></h1>
        <p><?= $quiz->getDescription() ?></p>

        <form action="edit_quiz.php" method="post">
            <label for="quiz_id"></label>
            <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz_id ?>">

            <input type="submit" value="Editar quiz">
        </form>
        <form action="../questions/add_question.php" method="post">
            <label for="quiz_id"></label>
            <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz_id ?>">

            <input type="submit" value="Añadir pregunta">
        </form>
    </aside>

    <main class="principal">
        <h1>Preguntas</h1>

        <?php
        require_once '../db/Question.php';

        $my_model = Model::getInstance();
        $array_questions = $my_model->obtener_preguntas_quiz($quiz_id);
        ?>

        <?php
        if (empty($array_questions)) {
            echo "<p>Este quiz no tiene preguntas</p>";
        } else {
            foreach ($array_questions as $question) {
        ?>
        <article>
            <h1><?= $question->getQuestionText() ?></h1>

            <ol type="a">
                <li><?= $question->getOptionA() ?></li>
                <li><?= $question->getOptionB() ?></li>
                <li><?= $question->getOptionC() ?></li>
                <li><?= $question->getOptionD() ?></li>
            </ol>

            <p>Respueta correcta: <?= $question->getCorrectOption() ?></p>

            <div>
                <form action="../questions/edit_question.php" method="post">
                    <label for="question_id"></label>
                    <input type="hidden" id="question_id" name="question_id" value="<?= $question->getQuestionId() ?>">
                    <input type="submit" value="Editar">
                </form>

                <form action="../questions/delete_question.php" method="post">
                    <label for="question_id"></label>
                    <input type="hidden" id="question_id" name="question_id" value="<?= $question->getQuestionId() ?>">
                    <input type="submit" value="Eliminar">
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
