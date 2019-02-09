<?php
require('app/model.php');

$model = new Model();
$model->newConnect();
$question = $model->getQuestionById((int)$_GET['id']);
$categoryes = $model->getCategoryes();

//        echo '<pre>';
//        var_dump($question);
//        echo '</pre>';
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

            <input type="text" name="method" value="editQuestion" hidden>
            <input type="text" name="question_id" value="<?=$question['question_id']?>" hidden>

            <div style="display: inline-block; float: left;">
                <textarea name="question" rows="4" cols="45"> <?=$question["question"]?></textarea>
            </div>
            <div style="display: inline-block; margin-left: 5px;">
                <select size="1" name="category_id">
                    <option disabled >Выберите категорию</option>
                    <?php
                        foreach ($categoryes as $result => $value) {
                            ?>
                            <option value="<?=$value['id']?>" <?=($value['category']==$question['category']? "selected" : "") ?>><?=$value['category']?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <div style="margin-top: 10px;">
            <div style="display: inline-block"> Автор:</div>
            <div style="display: inline-block">
                <input name="userName" type="text" value="<?=$question["userName"]?>">
            </div>
        </div>

        <div style="margin-top: 10px;">
            <div style="display: inline-block; float: left; margin-right:5px;"> Ответ:</div>
            <div style="display: inline-block; float: left;">
                <textarea name="answer" rows="4" cols="45" name="question"><?=$question["answer"]?></textarea>
                <input type="text" name="answer_id" value="<?=$question['answer_id'];?>" hidden>
            </div>
        </div>

        <div class="clear" style="margin-top: 5px;">
            <input type="submit" value="Сохранить изменения">
        </div>
    </form>

</section>

<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>