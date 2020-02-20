<?php
namespace app\model;
use app\engine\Db;

class Users extends DbModel
{
    public $id;
    public $login;
    public $pass;

    /**
     * Users constructor.
     * @param $id
     * @param $login
     * @param $pass
     */
    public function __construct($id = null, $login = null, $pass = null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;
    }


    public static function getTableName()
    {
        return "users";
    }

    public function authUser() {
        $sql = "SELECT * FROM users WHERE login = :login";
        $hash_pass = Db::getInstance()->queryOne($sql, ['login' => $this->login])['pass'];
        if ($this->login == 'admin' and password_verify($this->pass, $hash_pass)) {
            $_SESSION['login'] = $this->login;
            unset($_SESSION['wrong']);
        }else{
            $_SESSION['wrong'] = 'не верный пароль или логин';
        }
}

    public static function isAuth() {
        return isset($_SESSION['login']);
    }

    public static function getUser() {
        return $_SESSION['login'];
    }

    public static function isAdmin() {
        return $_SESSION['login'] == 'admin';
    }

}