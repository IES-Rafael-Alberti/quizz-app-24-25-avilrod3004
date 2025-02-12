<?php
class Quiz {
    private $quiz_id;
    private $title;
    private $description;
    private $owner;

    public function __construct($follow = true) {

    }

    public function getQuizId() {
        return $this->quiz_id;
    }

    public function setQuizId($quiz_id) {
        $this->quiz_id = $quiz_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
    }


}