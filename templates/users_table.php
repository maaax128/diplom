<form action="controller/usersController.php" method="get">
    <input type="text" name="action" value="addAdmin" hidden>
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

        <form action="controller/usersController.php" method="get" enctype="">
            <input type = "text" name="id" value="<?=$value['id']; ?>" hidden>
            <input type = "text" name="action" value="changePassword" hidden>
            <input type ="submit" value="сменить пароль">
        </form>

        </td>
        <td>
            <form id="deleteAdmin" action="controller/innerController.php" method="post">
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