<?php
var_dump((int)$_GET['id']);

require('app/model.php');

$model = new Model();
$model->newConnect();
$question = $model->getQuestionById((int)$_GET['id']);
$categoryes = $model->getCategoryes();

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

        <div class="cd-faq-items" style="margin-top: 10px;">
            <div style="display: inline-block;">
             <textarea rows="4" cols="45" name="question"> <?=$question["question"]?></textarea>
            </div>
        </div>
</section>

<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>