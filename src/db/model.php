<?php

class Model {
    private $conn;
    private static $instance;

    private function __construct() {
        $this->conn = new PDO("mysql:host=db;dbname=quizzes", "root", "pestillo");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new Model();
        }
        return self::$instance;
    }

    // TABLA DE USUARIOS - USUARIOS
    public function crea_usuario($username, $password) {
        $statement = $this->conn->prepare("INSERT INTO usuarios (username, password) VALUES (:username, :password)");
        $statement->execute(array(":username" => $username, ":password" => crypt($password, "juas")));
        return $statement->rowCount();
    }

    public function check_user($username, $password) {
        $statement = $this->conn->prepare("SELECT count(*) FROM usuarios WHERE username = :username AND password = :password");
        $statement->execute(array(":username" => $username, ":password" => crypt($password, "juas")));
        return $statement->fetch()[0] == 1;
    }


    // TABLA DE CUESTIONARIOS - QUIZ

    /**
     * Registrar un nuevo quiz
     * @param $title - Título
     * @param $description - Descripción
     * @return int Número de filas afeactadas, 1
     */
    public function crear_quiz($title, $description) {
        $statement = $this->conn->prepare("INSERT INTO quiz (title, description) VALUES (:title, :description)");
        $statement->execute(array(":title" => $title, ":description" => $description));
        return $statement->rowCount();
    }

    public function obtener_quizzes_instructor($id_instructor) {
        $statement = $this->conn->prepare("SELECT * FROM quiz WHERE owner = :id_instructor");
        $statement->execute(array(":id_instructor" => $id_instructor));
        return $statement->fetchAll(PDO::FETCH_CLASS, "Cuestionarios", array("follow" => true));
    }
}
