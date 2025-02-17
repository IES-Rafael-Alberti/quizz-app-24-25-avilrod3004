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
    <title>Perfil</title>
</head>
<body class="contenedor">
    <header class="encabezado">
        <img src="../img/quizzes!.png" alt="Quizzes App" class="encabezado__logo">
        <nav class="encabezado__navegacion">
            <ul class="navegacion__listado">
                <li class="listado__opcion"><a href="logout.php" class="opcion__enlace">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <?php
    require_once '../db/model.php';
    require_once '../db/Quiz.php';

    $my_model = Model::getInstance();
    $array_quizzes = $my_model->obtener_quizzes_instructor($_SESSION["id"]);
    ?>

    <aside class="lateral">
        <h1 class="lateral__nombre"><?php echo $_SESSION["username"]; ?></h1>

        <?php
        if ($_SESSION["rol"] == "instructor") {
        ?>
        <p class='lateral__info'>Rol: instructor</p>

        <p class="lateral__info">Quizzes creados: <?= count($array_quizzes) ?></p>

        <form action="../quizzes/new_quiz.php" method="get">
            <button type="submit" class="boton">Crear quiz</button>
        </form>
        <?php
        } else {
            echo "<p class='lateral__info'>Rol: estudiante</p>";
        }
        ?>
    </aside>

    <main class="principal">
        <?php
        if ($_SESSION["rol"] == "instructor") {
        ?>
            <h1 class="principal__titulo">Listado quizzes</h1>

            <?php
            if (empty($array_quizzes)) {
                echo "
                        <div class='principal__sin-contenido'>
                            <p class='sin-contenido__texto'>Todavía no tienes quizzes creados</p>
                        </div>
                    ";
            }

            foreach ($array_quizzes as $quiz) {
                ?>
                <article class="quiz">
                    <div class="quiz__texto">
                        <h1 class="texto-quiz__titulo"><?= $quiz->getTitle() ?></h1>
                        <p class="texto-quiz__descripcion"><?= $quiz->getDescription() ?></p>
                    </div>

                    <div class="quiz__acciones">
                        <form action="../quizzes/info_quiz.php" method="post">
                            <label for="quiz_id"></label>
                            <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz->getQuizId() ?>">

                            <input type="submit" value="Consultar" class="boton__consultar">
                        </form>

                        <form action="../quizzes/delete_quiz.php" method="post">
                            <label for="quiz_id"></label>
                            <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz->getQuizId() ?>">

                            <input type="submit" value="Eliminar" class="boton__eliminar">
                        </form>
                    </div>
                </article>
                <?php
            }
            ?>
        <?php
        } else {
            echo '<h1 class="principal__titulo">Quizzes disponibles</h1>';

            $lista_quizzes = $my_model->listar_quizzes();

            if (empty($lista_quizzes)) {
                echo "
                        <div class='principal__sin-contenido'>
                            <p class='sin-contenido__texto'>No quizzes disponibles...</p>
                        </div>
                    ";
            }

            foreach ($lista_quizzes as $quiz) {
        ?>
                <article class="quiz">
                    <div class="quiz__texto">
                        <h1 class="texto-quiz__titulo"><?= $quiz->getTitle() ?></h1>
                        <p class="texto-quiz__descripcion"><?= $quiz->getDescription() ?></p>
                    </div>

                    <div class="quiz__acciones">
                        <form action="../quizzes/info_quiz.php" method="post">
                            <label for="quiz_id"></label>
                            <input type="hidden" id="quiz_id" name="quiz_id" value="<?= $quiz->getQuizId() ?>">

                            <input type="submit" value="Hacer quiz" class="boton__consultar">
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
