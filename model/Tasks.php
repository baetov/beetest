<?php

namespace app\model;


class Tasks extends DbModel
{
    public $id;
    public $username;
    public $email;
    public $description;
    public $status;


    public function __construct($id = null, $username = null, $email = null, $description = null,$status = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->description = $description;
        $this->status = $status;
    }


    public static function getTableName()
    {
        return "tasks";
    }


}