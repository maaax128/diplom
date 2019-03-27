<?php
require('../model/Connect.php');
require('../model/Questions.php');
$model = new questions();
$model->newConnect();

switch ($_GET['action']) {
    //форма создания вопроса
    case 'questionUser':
        //получем категории
        $categoryes = $model->getCategoryes();

        $title = "Задать вопрос";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/front/questionUser.php";
        break;
};

switch ($_POST['action']) {
    // добавление вопроса в базу
    case 'addQuestionUser':
        $params = array("question"=>$_POST['userQuest'],
            "group"=>$_POST['category'],
            "answered"=>0,
            "name"=> $_POST['name'],
            "email"=>$_POST['email']
        );
        $model->addUserQuestion($params);
        header("Location:../index.php");
        break;

};

// подключение футера
include "../templates/foot.php";