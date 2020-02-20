<?php

namespace app\controllers;


use app\engine\Request;
use app\model\Users;

class AuthController extends Controller
{

    public function actionLogin() {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];

            (new Users(null, $login, $pass))->authUser();
            unset($_SESSION['error']);



        header("Location: /");
    }
    public function actionLogout() {

        unset($_SESSION['login']);

        header("Location: /");
    }


}