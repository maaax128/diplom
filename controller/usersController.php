<?php

require('../model/Connect.php');
require('../model/Users.php');
$model = new Users();
$model->newConnect();

if( $_POST['action'] == 'actionAuthorization') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            header("Location:../../index.php");
            exit;
        } else {
            $arr = [
                "login" => $_POST['login'],
                "password" => $_POST['password']
            ];
            //если не найден админ с таким логином и паролем
            if ($model->autorization($arr) == "no_admin") {
                include "../templates/head.php";
                echo "Нет пользователя с такими параметрами<br>";
                echo "<a href='../index.php'>На главную </a>";
            }
        }
}

switch ($_GET['action']) {

    case 'changePassword':
        $id=(int)$_GET['id'];
        $title= "Смена пароля";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/users/changePassword.php";
        break;

    case 'addAdmin':
        $title= "Регистрация нового администратора";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/users/addAdmin.php";
        break;

    case 'deleteAdmin':
        $title= "Регистрация нового администратора";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/users/addAdmin.php";
        break;

    case 'formAuthorization':
        $title= "Форма авторизации";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/users/formAuthorization.php";
        break;
}

// подключение футера
include "../templates/foot.php";