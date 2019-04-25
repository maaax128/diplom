<?php
require('../model/Connect.php');
require('../model/Questions.php');

switch ($_GET['action']) {
    //форма создания вопроса
    case 'questionUser':
        questionUser($model);
    break;
};

switch ($_POST['action']) {
    // добавление вопроса в базу
    case 'addQuestionUser':
        addQuestionUser();
    break;

};

// подключение футера
include "../templates/foot.php";

function questionUser() {
    $model = new questions();
    $model->newConnect();
    //получем категории
    $categoryes = $model->getCategoryes();

    $title = "Задать вопрос";
    //подключаем хедер
    include "../templates/head.php";
    // подключаем шаблон
    include "../templates/front/questionUser.php";
}

function addQuestionUser() {
    $model = new questions();
    $model->newConnect();

    $params = array("question"=>$_POST['userQuest'],
        "group"=>$_POST['category'],
        "answered"=>0,
        "name"=> $_POST['name'],
        "email"=>$_POST['email']
    );
    $model->addUserQuestion($params);
    header("Location:../index.php");
}