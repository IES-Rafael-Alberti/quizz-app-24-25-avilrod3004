<?php

class Question {
    private $question_id;
    private $quiz_id;
    private $question_text;
    private $option_a;
    private $option_b;
    private $option_c;
    private $option_d;
    private $correct_option;

    public function __construct($follow = true) {

    }


    public function getQuestionId() {
        return $this->question_id;
    }

    public function setQuestionId($question_id): void {
        $this->question_id = $question_id;
    }

    public function getQuizId() {
        return $this->quiz_id;
    }

    public function setQuizId($quiz_id): void {
        $this->quiz_id = $quiz_id;
    }

    public function getQuestionText() {
        return $this->question_text;
    }

    public function setQuestionText($question_text): void {
        $this->question_text = $question_text;
    }

    public function getOptionA() {
        return $this->option_a;
    }

    public function setOptionA($option_a): void {
        $this->option_a = $option_a;
    }

    public function getOptionB() {
        return $this->option_b;
    }

    public function setOptionB($option_b): void {
        $this->option_b = $option_b;
    }

    public function getOptionC() {
        return $this->option_c;
    }

    public function setOptionC($option_c): void {
        $this->option_c = $option_c;
    }

    public function getOptionD() {
        return $this->option_d;
    }

    public function setOptionD($option_d): void {
        $this->option_d = $option_d;
    }

    public function getCorrectOption() {
        return $this->correct_option;
    }

    public function setCorrectOption($correct_option): void {
        $this->correct_option = $correct_option;
    }


}