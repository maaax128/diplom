<?php
class Users
{
    static $connect = null;

    public function newConnect()
    {
        if(self::$connect==null) self::$connect = connect::get();
    }
    //добавление нового администратора
    public function addNewAdmin($var = [])
    {
        $login = $var['name'];
        $sth = self::$connect->prepare("SELECT id from admins WHERE login='$login'");
        $sth->execute();
        $sth = $sth->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($sth);

        if (!empty($sth)) {
            //Такой логин уже существует
            return null;
            exit;
        }

        $sth = self::$connect->prepare("INSERT INTO admins (login, password)
    		VALUES (:name,:password)");
        $sth->bindValue(':name', $var['name'], PDO::PARAM_STR);
        $sth->bindValue(':password', $var['password'], PDO::PARAM_STR);
        $sth->execute();

        return null;
    }
//получение всех админов
    public function getAdmins()
    {
        $sth = self::$connect->prepare('SELECT id,login,password FROM admins');
        $sth->execute();
        $resultAdmins = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $resultAdmins;
    }

//удаление админа
    public function deleteAdmins($id)
    {
        $sth = self::$connect->prepare('DELETE FROM admins WHERE id= :id');
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }
//смена пароля
    public function changePassword($arr)
    {
        $sth = self::$connect->prepare("UPDATE admins SET password = :password WHERE id = :id");
        $sth->bindValue(':id', (int)$arr['admin_id'], PDO::PARAM_INT);
        $sth->bindValue(':password', $arr['password'], PDO::PARAM_STR);
        $sth->execute();
    }
//авторизация админа
    public function autorization($arr){
        $sth = self::$connect->prepare("SELECT login from admins WHERE login=:login AND password = :password");
        $sth->bindValue(':login', $arr['login'], PDO::PARAM_STR);
        $sth->bindValue(':password', $arr['password'], PDO::PARAM_STR);
        $sth->execute();
        $sth = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($sth)) {
            header("Location:../controlPanel.php");
            session_start();
            $_SESSION['user'] =  $arr['login'];
        } else {
            return "no_admin";
        }
    }
}