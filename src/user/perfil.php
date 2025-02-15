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
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <title>Perfil</title>
</head>
<body class="contenedor">
    <header class="encabezado">
        <h1 class="encabezado__titulo">Quizzes App</h1>

        <nav class="encabezado__navegacion">
            <ul class="navegacion__listado">
                <li class="listado__opcion"><a href="logout.php" class="opcion__enlace">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <aside class="lateral">
        <p><?php echo $_SESSION["username"]; ?></p>

        <?php
        if ($_SESSION["rol"] == "instructor") {
            echo "<p>Usuario con rol de instructor</p>";
        } else {
            echo "<p>Usuario con rol de estudiante</p>";
        }
        ?>

        <form action="../quizz/new_quiz.php" method="get">
            <button type="submit">Crear quiz</button>
        </form>
    </aside>

    <main class="principal">
        <h1>Listado quizzes</h1>

        <?php
        require_once '../db/model.php';
        require_once '../db/Quiz.php';

        $my_model = Model::getInstance();
        $array_quizzes = $my_model->obtener_quizzes_instructor($_SESSION["id"]);
        ?>

        <?php
        foreach ($array_quizzes as $quiz) {
            ?>
            <article>
                <h1><?= $quiz->getTitle() ?></h1>
                <p><?= $quiz->getDescription() ?></p>
                <div>
                    <form action="../quizz/info_quiz.php" method="post">
                        <label for="quiz_id"></label>
                        <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz->getQuizId() ?>">

                        <input type="submit" value="Consultar">
                    </form>

                    <form action="../quizz/delete_quiz.php" method="post">
                        <label for="quiz_id"></label>
                        <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz->getQuizId() ?>">

                        <input type="submit" value="Eliminar">
                    </form>
                </div>
            </article>

            <hr>
            <?php
        }
        ?>
    </main>
    <footer class="pie">
        <p>soy el footer</p>
    </footer>
</body>
</html>
