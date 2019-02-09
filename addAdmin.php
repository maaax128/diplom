<?php
require('connect.php');
require('selectCategory.php');

?>



<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Добавить нового администратора</title>
</head>
<body>
<form action="addNewADmins.php" method="post" enctype="multipart/form-data">
<fieldset>


 <legend>Введите данные</legend>
 <input type="text" name="name" placeholder="Введите имя">
 <input type="text" name="password" placeholder="Введите пароль">
 <input type="submit" name="" value="Отправить">

</fieldset>
</form>
<p><a href="controlPanel.php">Вернуться в панель администратора</a></p>    

</body>
</html>