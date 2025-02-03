<?php
session_start();
if(!isset($_SESSION["username"])) {
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
    <title>Perfil</title>
</head>
<body>
    <header>
        <h1>Quizzes</h1>
    </header>

    <main>
        <aside>
            <p><?php echo $_SESSION["username"]; ?></p>

            <form action="crear_quizz.php" method="get">
                <button type="submit">Crear quizz</button>
            </form>
        </aside>

        <section>
            <h1>Listado quizzes</h1>
        </section>
    </main>

    <footer>

    </footer>
</body>
</html>
