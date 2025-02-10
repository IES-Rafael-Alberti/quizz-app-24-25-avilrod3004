<?php
session_start();      // Inicia la sesión (necesario para acceder a la sesión actual)
session_destroy();    // Destruye la sesión actual

// Redirige al usuario a la página de login (o a otra página)
header("Location: login.php");
exit();

