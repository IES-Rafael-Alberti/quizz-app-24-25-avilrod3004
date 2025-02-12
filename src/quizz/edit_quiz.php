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

    <aside>
        <form action="" method="post">
            <label for="title">Titulo</label>
            <input type="text" id="title" name="title" value="<?= $quiz->getTitle() ?>">

            <label for="description">Descripción</label>
            <textarea name="" id="description" cols="30" rows="5"><?= $quiz->getDescription() ?></textarea>

            <input type="submit" value="Guardar">
        </form>

        <form action="" method="post">
            <input type="submit" value="Añadir pregunta">
        </form>
    </aside>

    <section>
        <h1>Preguntas</h1>

        <?php
        require_once '../db/model.php';
        require_once '../db/Question.php';

        $my_model = Model::getInstance();
        $array_questions = $my_model->obtener_preguntas_quiz($quiz_id);
        ?>

        <?php
        if (!empty($array_questions)) {
            foreach ($array_questions as $question) {
        ?>
            <article>
                <h1><?= $question->getQuestionText() ?></h1>

                <ul>
                    <li>a) <?= $question->getOptionA() ?></li>
                    <li>b) <?= $question->getOptionB() ?></li>
                    <li>c) <?= $question->getOptionC() ?></li>
                    <li>d) <?= $question->getOptionD() ?></li>
                </ul>

                <p><?= $question->getCorrectOption() ?></p>

                <div>
                    <form action="" method="post">
                        <label for="question_id"></label>
                        <input type="hidden" id="question_id" name="question_id" value="<?= $quiz->getQuestionId() ?>">

                        <input type="submit" value="Editar">
                    </form>

                    <form action="" method="post">
                        <label for="question_id"></label>
                        <input type="hidden" id="question_id" name="question_id" value="<?= $quiz->getQuestionId() ?>">

                        <input type="submit" value="Eliminar">
                    </form>
                </div>
            </article>
        <?php
            }
        } else {
            echo "<p>Este quiz no tiene preguntas</p>";
        }
        ?>

    </section>
</body>
</html>
