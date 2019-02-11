<?php
//session_start();
//$_SESSION['admin_id'] = $_POST['admin_id'];
$id=(int)$_GET['id'];
?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Смена пароля</title>
</head>
<body>
<form action="controller.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Введите новый пароль</legend>
    <input type="text" name="method" value="changePassword" hidden>
    <input type="text" name="admin_id" value="<?=$id?>" hidden>
    <input type="text" name="password" placeholder="Введите пароль">
    <input type="submit" value="Отправить">
</fieldset>
</form>
<p><a href="controlPanel.php">Вернуться в панель администратора</a></p>    


</body>
</html>