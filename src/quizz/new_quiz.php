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
    <title>Nuevo quiz</title>
</head>
<body>
    <main>
        <form action="create_quiz.php" method="post">
            <label for="title">Titulo</label>
            <input type="text" id="title" name="title">

            <label for="description">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="5"></textarea>

            <button type="submit">Registrar quiz</button>
        </form>

        <?php
        if (isset($_GET["error"])) {
            echo '<span class="error">' . $_GET["error"] . "</span>";
        }
        ?>
    </main>
</body>
</html>
