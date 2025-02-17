<?php
session_start();
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
    <title>Registro</title>
</head>
<body class="contenedor-formulario">
    <header class="encabezado">
        <img src="../img/quizzes!.png" alt="Quizzes App" class="encabezado__logo">
        <nav class="encabezado__navegacion">
            <ul class="navegacion__listado">
                <li class="listado__opcion"><a href="../user/login.php" class="opcion__enlace">Iniciar sesión</a></li>
                <li class="listado__opcion"><a href="../user/register.php" class="opcion__enlace">Crear cuenta</a></li>
            </ul>
        </nav>
    </header>

    <main class="principal-formulario">
        <h1 class="principal__titulo">Crear una cuenta</h1>

        <form action="create_user.php" method="post" class="principal-formulario__formulario">
            <label for="username">Nombre de usuario</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <label for="rol">Tipo de perfil</label>
            <select name="rol" id="rol" class="formulario__select" required>
                <option value="">Selecciona una opción</option>
                <option value="estudiante">Estudiante</option>
                <option value="instructor">Instructor</option>
            </select>

            <button type="submit" class="boton">Crear cuenta</button>
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
