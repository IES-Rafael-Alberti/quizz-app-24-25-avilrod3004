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
    public function crea_usuario($username, $password, $rol) {
        $statement = $this->conn->prepare("INSERT INTO usuarios (username, password, rol) VALUES (:username, :password, :rol)");
        $statement->execute(array(":username" => $username, ":password" => crypt($password, "juas"), ":rol" => $rol));
        return $statement->rowCount();
    }

    public function check_user($username, $password) {
        $statement = $this->conn->prepare("SELECT count(*) FROM usuarios WHERE username = :username AND password = :password");
        $statement->execute(array(":username" => $username, ":password" => crypt($password, "juas")));
        return $statement->fetch()[0] == 1;
    }


    // TABLA DE CUESTIONARIOS - QUIZ

    public function crear_quiz($title, $description, $owner): int {
        $statement = $this->conn->prepare("INSERT INTO quiz (title, description, owner) VALUES (:title, :description, :owner)");
        $statement->execute(array(":title" => $title, ":description" => $description, ":owner" => $owner));
        return $statement->rowCount();
    }

    public function obtener_quizzes_instructor($id_instructor): array {
        $statement = $this->conn->prepare("SELECT * FROM quiz WHERE owner = :id_instructor");
        $statement->execute(array(":id_instructor" => $id_instructor));
        return $statement->fetchAll(PDO::FETCH_CLASS, "Quiz", array("follow" => true));
    }

    public function obtener_quiz($quiz_id) {
        $statement = $this->conn->prepare("SELECT * FROM quiz WHERE quiz_id = :quiz_id");
        $statement->execute(array(":quiz_id" => $quiz_id));
        return $statement->fetchObject("Quiz");
    }

    public function update_quiz($quiz_id, $title, $description, $owner): int {
        $statement = $this->conn->prepare("UPDATE quiz SET title = :title, description = :description, owner = :owner WHERE quiz_id = :quiz_id");
        $statement->execute(array(":title" => $title, ":description" => $description, ":owner" => $owner, ":quiz_id" => $quiz_id));
        return $statement->rowCount();
    }

    public function borrar_quiz($quiz_id) {
        $statement = $this->conn->prepare("DELETE FROM quiz WHERE quiz_id = :quiz_id");
        $statement->execute(array(":quiz_id" => $quiz_id));
        return $statement->rowCount();
    }


    // TABLA DE PREGUNTAS - QUESTION

    public function crear_pregunta($quiz_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option): int {
        $statement = $this->conn->prepare("INSERT INTO question (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option) 
                                                VALUES (:quiz_id, :question_text, :option_a, :option_b, :option_c, :option_d, :correct_option)");
        $statement->execute(array(":quiz_id" => $quiz_id, ":question_text" => $question_text, ":option_a" => $option_a, ":option_b" => $option_b, ":option_c" => $option_c, ":option_d" => $option_d, ":correct_option" => $correct_option));
        return $statement->rowCount();
    }

    public function obtener_pregunta ($question_id) {
        $statement = $this->conn->prepare("SELECT * FROM question WHERE question_id = :question_id");
        $statement->execute(array(":question_id" => $question_id));
        return $statement->fetchObject("Question");
    }

    public function obtener_preguntas_quiz ($quiz_id): array {
        $statement = $this->conn->prepare("SELECT * FROM question WHERE quiz_id = :quiz_id");
        $statement->execute(array(":quiz_id" => $quiz_id));
        return $statement->fetchAll(PDO::FETCH_CLASS, "Question");
    }

    public function update_question ($question_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option): int {
        $statement = $this->conn->prepare("UPDATE question SET question_text = :question_text, option_a = :option_a, option_b = :option_b, option_c = :option_c, option_d = :option_d, correct_option = :correct_option WHERE question_id = :question_id");
        $statement->execute(array(":question_id" => $question_id, ":question_text" => $question_text, ":option_a" => $option_a, ":option_b" => $option_b, ":option_c" => $option_c, ":option_d" => $option_d, ":correct_option" => $correct_option));
        return $statement->rowCount();
    }

    public function borrar_question ($question_id): int {
        $statement = $this->conn->prepare("DELETE FROM question WHERE question_id = :question_id");
        $statement->execute(array(":question_id" => $question_id));
        return $statement->rowCount();
    }
}
