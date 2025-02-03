<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de usuarios</title>
</head>
<body>
<header>

</header>

<main>
    <form action="create_user.php" method="post">
        <label for="username">Nombre de usuario</label>
        <input type="text" id="username" name="username">

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password">

        <button type="submit">Crear cuenta</button>
    </form>

    <?php
    if(isset($_GET["error"])) {
        echo '<span class="error">' . $_GET["error"] . "</span>";
    }
    ?>
</main>

<footer>

</footer>
</body>
</html>
