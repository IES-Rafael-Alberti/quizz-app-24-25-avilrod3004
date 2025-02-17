<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
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
    <title>Nuevo quiz</title>
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

    <main class="principal-formulario">
        <h1 class="principal__titulo">Nuevo quiz</h1>
        <form action="create_quiz.php" method="post" class="principal-formulario__formulario">
            <label for="title">Titulo</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="5" required></textarea>

            <button type="submit" class="boton">Registrar quiz</button>
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
