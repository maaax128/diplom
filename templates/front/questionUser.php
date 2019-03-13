<?php
   // var_dump($categoryes);
?>

<!--<form action="addQuestionUser.php" method="post" enctype="multipart/form-data">-->
<form action="../../controller/frontController.php" method="get" enctype="multipart/form-data">
    <fieldset>
         <legend>Контактная информация</legend>
        <input type="text" name="action" value="addQuestionUser" hidden>
         <input type="text" name="name" placeholder="Введите имя" required>
         <input type="text" name="email" placeholder="Введите ваш e-mail" required>
         <select size="1" name="category">
             <option disabled>Выберите категорию</option>
             <?php
             foreach ($categoryes as $result => $value) {
                 $group = $value['category'];
                 ?>
                 <option value="<?=$value['id']?>"><?=$group?></option>
             <?php } ?>
         </select>

         <p>
             <input size="65" type="text" name="userQuest" placeholder="Задайте вопрос" required>
         </p>
         <input type="submit" name="" value="Отправить">
    </fieldset>
</form>