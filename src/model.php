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

    public function crea_usuario($username, $password, $image = "anon.png") {
        $statement = $this->conn->prepare("INSERT INTO usuarios (username, password) VALUES (:username, :password)");
        $statement->execute(array(":username" => $username, ":password" => crypt($password, "juas")));
        return $statement->rowCount();
    }

    public function check_user($username, $password) {
        $statement = $this->conn->prepare("SELECT count(*) FROM usuarios WHERE username = :username AND password = :password");
        $statement->execute(array(":username" => $username, ":password" => crypt($password, "juas")));
        return $statement->fetch()[0] == 1;
    }
}
