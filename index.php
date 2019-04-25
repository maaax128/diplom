<?php
require('model/Connect.php');
require('model/Answers.php');
require('model/Questions.php');


$model = new questions();
$model->newConnect();

$categoryes = $model->getCategoryes();
$questions = $model->getQuestions();

$answers = new answers();
$answers->newConnect();
$resultAnswers = $answers->getAnswers();

		/*echo '<pre>';
		var_dump($resultAnswers);
		echo '</pre>';*/

//require('selectCategory.php');
//require('selectQuestions.php');
//require('selectAnswers.php');


$title = "Вопрос-ответ";
include "templates/head.php";
include "templates/index_main.php";
include "templates/foot.php";
