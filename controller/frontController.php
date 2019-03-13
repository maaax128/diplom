<?php
require('../model/Connect.php');
require('../model/Questions.php');
$model = new questions();
$model->newConnect();

switch ($_GET['action']) {
    case 'questionUser':
        //получем категории
        $categoryes = $model->getCategoryes();

        $title= "Задать вопрос";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/front/questionUser.php";
        break;

    case 'addQuestionUser':
        $params = array("question"=>$_GET['userQuest'],
            "group"=>$_GET['category'],
            "answered"=>0,
            "name"=> $_GET['name'],
            "email"=>$_GET['email']
        );
        $model->addUserQuestion($params);
        header("Location:../index.php");
        break;

}

// подключение футера
include "../templates/foot.php";