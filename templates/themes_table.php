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
            <form id="deleteCategory" action="controller/innerController.php" method="post">
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
                            <form id="deleteQuestion" action="controller/innerController.php" method="post" style="display: inline-block">
                                <input type="text" name="questionId" value="<?=$v['id'];?>" hidden>
                                <input type="text" name="method" hidden value="deleteQuestion">
                                <input type="submit" value="Удалить">
                            </form>

                            <?php if($v['status']==1) {?>
                                <form action="controller/innerController.php" method="post" style="display: inline-block">
                                    <input type="text" name="questionId" value="<?=$v['id'];?>" hidden>
                                    <input type="text" name="status" value="<?=$v['status'];?>" hidden>
                                    <input type="text" name="method" hidden value="hideQuestion">
                                    <input type="submit" value="Скрыть">
                                </form>
                            <?php }else if($v['status']==2){ ?>
                                <form action="controller/innerController.php" method="post" style="display: inline-block">
                                    <input type="text" name="questionId" value="<?=$v['id'];?>" hidden>
                                    <input type="text" name="status" value="<?=$v['status'];?>" hidden>
                                    <input type="text" name="method" hidden value="hideQuestion">
                                    <input type="submit" value="Показать">
                                </form>
                            <?php } ?>

<!--                            <form action="editquestion.php" method="get" style="display: inline-block">-->
                            <form action="controller/questionController.php" method="get" style="display: inline-block">
                                <input type="text" name="action" value="editquestion" hidden>
                                <input type="text" name="id" value="<?=$v['id'];?>" hidden>
                                <?php
                                if($v['answered']!=1) { ?>
                                    <input type="text" name="type" value="notanswered" hidden>
                                <?php }?>
                                <input type="submit" value="Редактировать">
                            </form>

                            <?php if($v['status']==0) { ?>
                                <form action="controller/questionController.php" method="get" style="display: inline-block">
                                    <input type="text" name="action" value="addAnswer" hidden>
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
    <form id="categoryName" action="controller/innerController.php" method="POST" enctype="">
        <input type="text" name="categoryName" placeholder="Название темы" required>
        <input type="text" name="method" hidden value="addCategory">
        <input type="submit" value="Добавить тему">
    </form>
</div>