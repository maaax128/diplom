<?php
session_start();
//var_dump($_SESSION);
require('connect.php');
require('selectAdmins.php');

require('app/model.php');

$model = new Model();
$model->newConnect();
$categoryes = $model->getCategoryes();

//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    if (!empty($_POST) && isset($_POST['categoryName'])){
//        if ($_POST['categoryName'] && trim($_POST['categoryName']) != "") {
//
//           // $_POST['categoryName'] = "";
//
//           // header("Location:controlPanel.php");
//        }
//    }
//    //die('test');
//}

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
<?php 
if ($_SESSION['login'] === 'admin') {
?>
<header>
    <h2>Список администраторов</h2>
</header>
<section class="cd-faq">
    <div class="cd-faq-items">

    <form action="addAdmin.php" method="post" enctype="">
        <input type="submit" name="newAdmin" value="Добавить администратора">
    </form>

	<table>
        <tr>
            <th>№</th>
            <th>id</th>
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
        <td><?php echo $value['id']; ?></td>
        <td><?php echo $value['login']; ?></td>
        <td><?php echo $value['password']; ?></td>
        <td>

        <form action="changePassword.php" method="post" enctype="">        
            <input type="hidden" name="admin_id" value="<?=$value['id']?>">
            <input type="submit" name="" value="сменить пароль">
        </form>

        </td>
        <td>
            <form action="delete.php" method="post" enctype="">
            <input type="hidden" name="admin_id" value="<?=$value['id']?>">
            <?php
                if ($value['login'] === 'admin') {
                    echo 'это Вы';
                    
                 } 
                 else {
                     ?><input type="submit" name="" value="удалить"><?php
                 }
            ?>
            </form>
        </td>


    </tr>
<?php   
}
} 
?>
</table>
</div>
<div class="cd-faq-items" style="margin-top: 30px;">
    <h2>Список тем: </h2>
    <ul class="cd-faq-group">
        <?php
            foreach ($categoryes as $result => $value) {
                $group = $value['category'];
                $id_category = $value['id'];
                $countAll = $model->getCountQuestion($id_category, false);
                $countAnswered = $model->getCountQuestion($id_category,true);
                $coountNotAnswered = $countAll-$countAnswered;
                ?>
                <form id="deleteCategory" action="category.php" method="post">
                    <li class="cd-faq-title"><?php echo "<h2>$group</h2>"; ?></li>
                    <div style="margin-left: 10px;">
                        <div style="margin-bottom: 5px;">
                            Всего вопросов: <?=$countAll?>
                        </div>
                        <div style="margin-bottom: 5px;">
                            Опубликовано: <?=$countAnswered?>
                        </div>
                        <div style="margin-bottom: 5px;">
                            Вопросов без ответов: <?=$coountNotAnswered?>
                        </div>
                    </div>
                    <input type = "text" name="categoryId" value="<?=$id_category?>" hidden>
                    <input type="text" name="method" hidden value="deleteCategory">
                    <input type="submit" value="Удалить категорию">
                </form>

            <?php }?>
    </ul>
    <div style="margin-top: 20px">
        <h2>Добавление новой темы</h2>
    </div>
    <div style="margin-top: 10px">
        <form id="categoryName" action="category.php" method="POST" enctype="">
            <input type="text" name="categoryName" placeholder="Название темы" required>
            <input type="text" name="method" hidden value="addCategory">
            <input type="submit" value="Добавить тему">
        </form>
    </div>
</div>
</section>
</body>
</html>