<?php

$title= "Регистрация нового администратора";
include "templates/head.php";

?>


<form action="addNewADmins.php" method="post" enctype="multipart/form-data">
<fieldset>


 <legend>Введите данные</legend>
 <input type="text" name="name" placeholder="Введите имя" required>
 <input type="text" name="password" placeholder="Введите пароль" required>
 <input type="submit" name="" value="Отправить">

</fieldset>
</form>
<p><a href="controlPanel.php">Вернуться в панель администратора</a></p>    

</body>
</html>