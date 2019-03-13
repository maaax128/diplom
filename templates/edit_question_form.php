<form action="../controller.php" method="post">
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
                    <option value="<?=$value['id']?>" <?=($value['id']==$question['id_category']? "selected" : "") ?>><?=$value['category']?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div style="margin-top: 10px;">
        <div style="display: inline-block"> Автор:</div>
        <div style="display: inline-block">
            <input name="userName" type="text" value="<?=$question["userName"]?>" >
        </div>
    </div>

    <?php
    if(!isset($_GET['type'] )) {
        ?>

        <div style="margin-top: 10px;">
            <div style="display: inline-block; float: left; margin-right:5px;"> Ответ:</div>
            <div style="display: inline-block; float: left;">
                <textarea name="answer" rows="4" cols="45" name="question"><?=$question["answer"]?></textarea>
                <input type="text" name="answer_id" value="<?=$question['answer_id'];?>" hidden>
            </div>
        </div>
    <?php } ?>

    <div class="clear" style="margin-top: 5px;">
        <input type="submit" value="Сохранить изменения">
    </div>
</form>