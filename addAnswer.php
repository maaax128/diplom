<?php
require('app/model.php');

$model = new Model();
$model->newConnect();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <title>Панель администратора</title>
</head>
<body>
<header>
    <h2>Редактирование вопроса</h2>
</header>
<section class="cd-faq">
    <form action="category.php" method="post">
        <div class="cd-faq-items" style="margin-top: 10px; display: table-row;">

            <input type="text" name="method" value="addAnswer" hidden>
            <input type="text" name="question_id" value="<?=$_POST["questionId"];?>" hidden>
            <input type="text" name="category_id" value="<?=$_POST["category_id"];?>" hidden>

            <div style="display: inline-block; float: left;">
                <textarea name="answer" rows="4" cols="45" placeholder="Введите ответ"></textarea>
            </div>

            <div class="clear" style="margin-top: 5px;">
                <select size="1" name="status">
                    <option disabled >Выберите статус</option>
                    <option value="1">Опубликовать</option>
                    <option value="2">Скрыть</option>
                </select>
            </div>

            <div class="clear" style="margin-top: 5px;">
                <input type="submit" value="Сохранить ответ">
            </div>
        </div>
    </form>
</section>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>