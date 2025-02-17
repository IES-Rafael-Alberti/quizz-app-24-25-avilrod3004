<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once '../db/model.php';
require_once '../db/Quiz.php';
require_once "../db/Question.php";
require_once "../db/Intentos.php";

if (!isset($_POST["quiz_id"])) {
    die("Error: No se ha proporcionado un ID de quiz.");
}

$quiz_id = $_POST["quiz_id"];
$my_model = Model::getInstance();
$quiz = $my_model->obtener_quiz($quiz_id);
$array_questions = $my_model->obtener_preguntas_quiz($quiz_id);

$total_preguntas = count($array_questions);
$correctas = 0;
$resultados = [];

foreach ($array_questions as $question) {
    $qid = $question->getQuestionId();

    $respuesta_usuario = $_POST[$qid] ?? null;
    $respuesta_correcta = $question->getCorrectOption();
    $es_correcto = ($respuesta_usuario === $respuesta_correcta);

    if ($es_correcto) {
        $correctas++;
    }

    $resultados[] = [
        "pregunta" => $question->getQuestionText(),
        "respuesta_usuario" => $respuesta_usuario,
        "respuesta_correcta" => $respuesta_correcta,
        "es_correcto" => $es_correcto
    ];
}

$nota = ($correctas / $total_preguntas) * 10;
$score = "$correctas / $total_preguntas (Nota: " . number_format($nota, 2) . ")";

$almacenado = false;
$almacenado = $my_model->registrar_intento($quiz_id, $_SESSION["id"], number_format($nota, 2));
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Quiz</title>
    <link rel="stylesheet" href=../css/reset.css>
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
</head>
<body class="contenedor">
    <header class="encabezado">
        <img src="../img/quizzes!.png" alt="Quizzes App" class="encabezado__logo">
        <nav class="encabezado__navegacion">
            <ul class="navegacion__listado">
                <li class="listado__opcion"><a href="../user/logout.php" class="opcion__enlace">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <aside class="lateral">
        <?php
        $historial_resultados = $my_model->obtener_intentos_quiz_user($quiz_id, $_SESSION["id"]);
        $suma_puntuacion = 0;

        foreach ($historial_resultados as $intento) {
            $suma_puntuacion += $intento->getPuntuacion();
        }
        ?>
        <h1 class="lateral__nombre">Estadistica</h1>
        <p class="lateral__info">Puntuación media: <?= $suma_puntuacion / count($historial_resultados) ?></p>
        <p class="lateral__info">Número de intentos: <?= count($historial_resultados) ?></p>

        <form action="../user/perfil.php" method="get">
            <button type="submit" class="boton">Volver al perfil</button>
        </form>
    </aside>

    <main class="principal">
        <h1 class="principal__titulo">Resultados de "<?= $quiz->getTitle() ?>"</h1>
        <h2>Puntuación: <?= $score ?></h2>
        <ul class="lista-resultado">
            <?php
            foreach ($resultados as $resultado):
            ?>
                <li class="lista-resultado__pregunta">
                    <p class="pregunta__enunciado">Pregunta: <?= $resultado["pregunta"] ?></p>
                    <p>Tu respuesta: <strong><?= strtoupper($resultado["respuesta_usuario"] ?? 'No respondida') ?></strong></p>
                    <p>Respuesta correcta: <strong><?= strtoupper($resultado["respuesta_correcta"]) ?></strong></p>
                    <p style="color: <?= $resultado["es_correcto"] ? 'green' : 'red' ?>">
                        <?= $resultado["es_correcto"] ? '✔ Correcto' : '✘ Incorrecto' ?>
                    </p>
                </li>
            <?php
            endforeach;
            ?>
        </ul>
    </main>

    <footer class="pie">
        <p>soy el footer</p>
    </footer>
</body>
</html>
