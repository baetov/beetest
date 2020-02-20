<?php


namespace app\controllers;

use app\engine\Request;
use app\model\Tasks;
use app\model\Users;


class TasksController extends Controller
{


    public function actionIndex()
    {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $quantityOnPage = 3;
        $from = ($page - 1) * $quantityOnPage;
        $pageCount = Tasks::getCount();
        $pageCount = ceil($pageCount / $quantityOnPage);

        $sort = $_GET['sort'];
        switch ($sort){
            case 'name-up';
            $sort = 'username ASC';
            break;

            case 'name-down';
            $sort = 'username DESC';
            break;

            case 'email-up';
            $sort = 'email ASC';
            break;

            case 'email-down';
            $sort = 'email DESC';
            break;

            case 'status-edited';
            $sort = 'status DESC';
            break;

            case 'status-not-edited';
            $sort = 'status ASC';
            break;

            default:
                $sort = 'id ASC';
                break;

        }

        echo $this->render('catalog', [
            'tasks' => Tasks::getLimit($from, $quantityOnPage, $sort),
            'pageCount' => $pageCount,
            'isAdmin' => Users::isAdmin()
        ]);
    }

    public function actionUpdate()
    {
        $task = Tasks::getOne($_GET['id']);

        if (!Users::isAdmin()){
            $_SESSION['alert'] = 'необходимо зарегистрироваться';
            header("Location: /");
        }

        if (!$task) {
        throw new \Exception('Задача не найдена', 404);
        }

        if (!empty($_POST)){
            $id = $task->id;
            $username = $task->username;
            $email = $task->email;
            $description = $_POST['description'];
            $status = 2;
            if ($description == $task->description){
                $status = 1;
            }

            (new Tasks($id,$username,$email,$description,$status))->save();
            header("Location: /");
        }


        echo $this->render('update', [
            'task' => $task,

        ]);
    }


    public function actionCreate(){

        if(count($_POST) > 0){

            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $description = htmlspecialchars($_POST['description']);
            $status = 0;
            if ($username != '' and $email != '' and $description != '') {
                unset($_SESSION['error'] );
                $_SESSION['sucess'] = 'добавлено успешно';
                ( new Tasks(null,$username,$email,$description,$status))->save();
                header("Location: /");
            }
            else{
                $_SESSION['error'] = 'вы ввели пустое поле';
                header("Location: /tasks/create");
            }


        }
        echo $this->render('create');
    }

    public function actionDestroyMessage()
    {
        unset($_SESSION['sucess'] );
        unset($_SESSION['alert'] );
        unset($_SESSION['wrong'] );
        unset($_SESSION['error'] );
    }




}