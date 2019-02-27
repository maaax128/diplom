<?php

    class answers
    {
        static $connect = null;

        public function newConnect()
        {
            self::$connect = connect::get();
        }

        public function addAnswer($arr)
        {
            $sql = "INSERT INTO answer (answer, id_category, id_questions) 
                      VALUES (:answer, :id_category, :id_questions)";
            $sth = self::$connect->prepare($sql);
            $sth->bindValue(':answer', $arr['answer'], PDO::PARAM_STR);
            $sth->bindValue(':id_category', (int)$arr['category_id'], PDO::PARAM_INT);
            $sth->bindValue(':id_questions', (int)$arr['question_id'], PDO::PARAM_INT);
            $sth->execute();

            $sql = "UPDATE questions SET answered = 1, status = :status where id= :id";
            $sth = self::$connect->prepare($sql);
            $sth->bindValue(':id', (int)$arr['question_id'], PDO::PARAM_INT);
            $sth->bindValue(':status', (int)$arr['status'], PDO::PARAM_INT);
            $sth->execute();
        }

        public function getAnswers()
        {
            $sth = self::$connect->prepare('SELECT id,answer,id_category,id_questions FROM answer');
            $sth->execute();
            $results = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }