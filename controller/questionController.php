<?php
switch ($_GET['action']) {
    case 'addAnswer':
        $title= "Ответить на вопрос";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/addAnswer.php";
    break;
}

// подключение футера
include "../templates/foot.php";