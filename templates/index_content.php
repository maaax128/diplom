<?php
foreach ($categoryes as $result => $value) {
    $group = $value['category'];
    ?>
    <li class="cd-faq-title"><?php echo "<h2>$group</h2>"; ?></li><?php
    foreach ($questions as $resultQuest => $valueQuest) {

        if ($valueQuest['id_category'] === $value['id'] && $valueQuest['answered'] == 1 && $valueQuest['status'] == 1) {
            $problem = $valueQuest['question'];
            ?>
            <a class="cd-faq-trigger" href="#0"><?php echo "$problem</br>"; ?></a>
            <?php
        }
        foreach ($resultAnswers as $resultAnswer => $valueAnswer) {
            ?>
            <?php
            if ($valueAnswer['id_category'] === $value['id'] && $valueAnswer['id_questions'] === $valueQuest['id']) {
                ?>
                <div class="cd-faq-content"><?php
                $reply = $valueAnswer['answer'];
                echo "<p>$reply</p>";
                ?></div><?php
            }

        }
    }
}