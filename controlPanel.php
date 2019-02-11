<?php
//session_start();

include('app/model.php');

$model = new Model();
$model->newConnect();
$categoryes = $model->getCategoryes();
$resultAdmins = $model->getAdmins();

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
    <h2>Панель администратора</h2>
</header>
<section class="cd-faq">
    <div class="cd-faq-items">

        <form action="addAdmin.php" method="post" enctype="">
            <input type="submit" name="newAdmin" value="Добавить администратора">
        </form>

        <table>
            <tr>
                <th>№</th>
                <th>Логин</th>
                <th>Пароль</th>
                <th>Сменить пароль</th>
                <th>Удалить</th>
            </tr>

    <?php
        $i = 1;
        foreach ($resultAdmins as $key => $value) { ?>
            <tr>
                <td>
                <?php
                echo "$i";
                $i ++;
                ?>
                </td>
                <td><?php echo $value['login']; ?></td>
                <td><?php echo $value['password']; ?></td>
                <td>

                <form action="changePassword.php" method="get" enctype="">
                    <input type = "text" name="id" value="<?=$value['id']; ?>" hidden>
                    <input type="submit" value="сменить пароль">
                </form>

                </td>
                <td>
                    <form id="deleteAdmin" action="controller.php" method="post">
                    <input type = "text" name="adminId" value="<?=$value['id']; ?>" hidden>
                    <input type="text" name="method" hidden value="deleteAdmin">
                    <?php
                        if ($value['login'] === 'admin') {
                            echo 'это Вы';
                         }
                         else {
                             ?><input type="submit" value="удалить администратора">
                     <?php } ?>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>


    <div class="cd-faq-items" style="margin-top: 30px;">
        <div class="line"></div>
        <h2>Список тем: </h2>

        <ul class="cd-faq-group">
            <?php
            foreach ($categoryes as $result => $value) {
                $group = $value['category'];
                $id_category = $value['id'];
                $countAll = $model->getCountQuestion($id_category, false);
                $countAnswered = $model->getCountQuestion($id_category,true);
                $countNotAnswered = $countAll - $countAnswered;
                ?>
                <div style="margin-left: 10px;">
                    <form id="deleteCategory" action="controller.php" method="post">
                        <li class="cd-faq-title"><?php echo "<h2>$group</h2>"; ?></li>
                        <div style="margin-bottom: 5px;">
                            Всего вопросов: <?=$countAll;?>
                        </div>
                        <div style="margin-bottom: 5px;">
                            Опубликовано: <?=$countAnswered;?>
                        </div>
                        <div style="margin-bottom: 5px;">
                            Вопросов без ответов: <?=$countNotAnswered;?>
                        </div>

                        <input type = "text" name="categoryId" value="<?=$id_category; ?>" hidden>
                        <input type="text" name="method" hidden value="deleteCategory">
                        <input type="submit" value="Удалить категорию">
                    </form>

                    <a class="cd-faq-trigger" href="#0">Список вопросов</a>
                    <div class="cd-faq-content">
                        <?php
                        $questions = $model->getQuestionsByCategory($id_category);
                        $i = 0;
                        foreach ($questions as $k=>$v) {
                        $i++;
                        ?>
                            <div>
                                <?=$i; ?>)
                                <?=$v["question"];?>
                                <span style="font-size: 11px; color:lightslategrey;">
                                            Дата: <?=$v['create_date'];?>
                                </span>
                                <span style="font-size: 12px; color: darkolivegreen"> Статус:
                                    <?php switch ($v['status']) {
                                        case 0: echo "Ожидает ответа"; break;
                                        case 1: echo "Опубликован"; break;
                                        case 2: echo "Скрыт"; break;
                                    }?>
                                </span>

                                <div>
                                    <form id="deleteQuestion" action="controller.php" method="post" style="display: inline-block">
                                        <input type="text" name="questionId" value="<?=$v['id'];?>" hidden>
                                        <input type="text" name="method" hidden value="deleteQuestion">
                                        <input type="submit" value="Удалить">
                                    </form>

                                    <?php if($v['status']==1) {?>
                                        <form action="controller.php" method="post" style="display: inline-block">
                                            <input type="text" name="questionId" value="<?=$v['id'];?>" hidden>
                                            <input type="text" name="status" value="<?=$v['status'];?>" hidden>
                                            <input type="text" name="method" hidden value="hideQuestion">
                                            <input type="submit" value="Скрыть">
                                        </form>
                                    <?php }else if($v['status']==2){ ?>
                                        <form action="controller.php" method="post" style="display: inline-block">
                                            <input type="text" name="questionId" value="<?=$v['id'];?>" hidden>
                                            <input type="text" name="status" value="<?=$v['status'];?>" hidden>
                                            <input type="text" name="method" hidden value="hideQuestion">
                                            <input type="submit" value="Показать">
                                        </form>
                                    <?php } ?>

                                    <form action="editquestion.php" method="get" style="display: inline-block">
                                        <input type="text" name="id" value="<?=$v['id'];?>" hidden>
                                        <?php
                                        if($v['answered']!=1) { ?>
                                            <input type="text" name="type" value="notanswered" hidden>
                                        <?php }?>
                                        <input type="submit" value="Редактировать">
                                    </form>

                                    <?php if($v['status']==0) { ?>
                                        <form action="addAnswer.php" method="post" style="display: inline-block">
                                            <input type="text" name="questionId" value="<?=$v['id'];?>" hidden>
                                            <input type="text" name="category_id" value="<?=$id_category;?>" hidden>
                                            <input type="submit" value="Ответить">
                                        </form>
                                    <?php } ?>
                                </div>

                            </div>
                        <?php }?>
                    </div>
                </div>
                <div class="line-hr"></div>
            <?php } ?>
        </ul>

        <div style="margin-top: 20px">
            <h2>Добавление новой темы</h2>
        </div>
        <div style="margin-top: 10px">
            <form id="categoryName" action="controller.php" method="POST" enctype="">
                <input type="text" name="categoryName" placeholder="Название темы" required>
                <input type="text" name="method" hidden value="addCategory">
                <input type="submit" value="Добавить тему">
            </form>
        </div>
    </div>
</section>

<section class="cd-faq">
    <div class="line-hr"></div> <div class="line-hr"></div>
    <h2>Список всех вопросов без ответов:</h2>
    <br>
    <?php
    $allQuestions = $model->getNotAnsweredQuestions();
    $i=0;
    foreach ($allQuestions as $k=>$v) {
        $i++;?>
        <div>
            <?=$i?>) <?=$v['question']?>
            <span style="font-size: 11px; color:lightslategrey;">
                       Дата: <?=$v['create_date'];?>
                </span>
            <div>
                <form id="deleteQuestion" action="controller.php" method="post" style="display: inline-block">
                    <input type="text" name="questionId" value="<?=$v['id']?>" hidden>
                    <input type="text" name="method" hidden value="deleteQuestion">
                    <input type="submit" value="Удалить">
                    </span>
                </form>

                <form action="editquestion.php" method="get" style="display: inline-block">
                    <input type="text" name="id" value="<?=$v['id']?>" hidden>
                    <input type="text" name="type" value="notanswered" hidden>
                    <input type="submit" value="Редактировать">
                </form>

            </div>
        </div>
    <?php } ?>
</section>


<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>