<?php

require('../model/Connect.php');
require('../model/Users.php');
$model = new Users();
$model->newConnect();

switch ($_GET['action']) {
    case 'actionAuthorization':
        if (empty($_GET['login']) || empty($_GET['password'])) {
            header("Location:../../index.php");
            exit;
        } else {
            $arr = [
                "login"=>$_GET['login'],
                "password"=>$_GET['password']
            ];
            //если не найден админ с таким логином и паролем
            if($model->autorization($arr) == "no_admin") {
                include "../templates/head.php";
                echo "Нет пользователя с такими параметрами<br>";
                echo "<a href='../index.php'>На главную </a>";
            }
        }
        break;

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