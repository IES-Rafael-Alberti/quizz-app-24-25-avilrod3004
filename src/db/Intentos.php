<?php

class Intentos {
    private $intento_id;
    private $quiz_id;
    private $user_id;
    private $puntuacion;

    function __construct($follow = true) {

    }

    public function getIntentoId() {
        return $this->intento_id;
    }

    public function setIntentoId($intento_id): void {
        $this->intento_id = $intento_id;
    }

    public function getQuizId() {
        return $this->quiz_id;
    }

    public function setQuizId($quiz_id): void {
        $this->quiz_id = $quiz_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id): void {
        $this->user_id = $user_id;
    }

    public function getPuntuacion() {
        return $this->puntuacion;
    }

    public function setPuntuacion($puntuacion): void {
        $this->puntuacion = $puntuacion;
    }


}