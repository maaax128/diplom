<!--<form action="../addNewADmins.php" method="post" enctype="multipart/form-data">-->
<form action="../controller.php" method="post" enctype="multipart/form-data">
    <fieldset>
         <legend>Введите данные</legend>
         <input type="text" name="name" placeholder="Введите имя" required>
         <input type="text" name="password" placeholder="Введите пароль" required>
        <input type="text" name="method" hidden value="addNewADmins">
         <input type="submit" name="" value="Отправить">
    </fieldset>
</form>
<p><a href="../../controlPanel.php">Вернуться в панель администратора</a></p>