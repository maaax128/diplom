<?php
require('../model/Connect.php');
require('../model/Questions.php');
$model = new questions();
$model->newConnect();

switch ($_GET['action']) {
    //форма добавления ответа
    case 'addAnswer':
        $title= "Ответить на вопрос";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/addAnswer.php";
    break;

  case 'editquestion':
        //форма редактирования вопроа
      if(isset($_GET['type'] ) && $_GET['type'] == 'notanswered'){
          $question = $model->getOneQuestion((int)$_GET['id']);
      } else {
          $question = $model->getQuestionById((int)$_GET['id']);
      }

      var_dump($question);

      $categoryes = $model->getCategoryes();

        $title= "Редактировать вопрос";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/edit_question_form.php";
    break;
}

// подключение футера
include "../templates/foot.php";