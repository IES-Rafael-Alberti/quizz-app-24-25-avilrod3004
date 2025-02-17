<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

if (!isset($_POST["quiz_id"])) {
    die("Error: No se ha proporcionado un ID de quiz.");
}

$quiz_id = $_POST["quiz_id"];
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
    <title>Nueva pregunta</title>
</head>
<body>
    <header class="encabezado">
        <img src="../img/quizzes!.png" alt="Quizzes App" class="encabezado__logo">
        <nav class="encabezado__navegacion">
            <ul class="navegacion__listado">
                <li class="listado__opcion"><a href="../user/logout.php" class="opcion__enlace">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main class="principal-formulario">
        <h1 class="principal__titulo">Nueva pregunta</h1>

        <form action="create_question.php" method="post" class="principal-formulario__formulario">
            <label for="quiz_id"></label>
            <input type="text" name="quiz_id" id="quiz_id" hidden="hidden" value="<?= $quiz_id ?>">

            <label for="question_text">Pregunta</label>
            <input type="text" id="question_text" name="question_text" required>

            <label for="option_a">Opción A</label>
            <input type="text" id="option_a" name="option_a" required>

            <label for="option_b">Opción B</label>
            <input type="text" id="option_b" name="option_b" required>

            <label for="option_c">Opción C</label>
            <input type="text" id="option_c" name="option_c" required>

            <label for="option_d">Opción D</label>
            <input type="text" id="option_d" name="option_d" required>

            <label for="correct_option">Opción correcta</label>
            <select name="correct_option" id="correct_option" class="formulario__correct_option" required>
                <option value="">Selecciona una opción</option>
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>

            <button type="submit" class="boton">Registrar quiz</button>
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
