<?php
namespace app\model;
use app\engine\Db;
/**
 * @var Db
 */
abstract class DbModel extends Models
{
    protected $db;


    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, [":id" => $id], static::class);
    }

    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }
    public static function getLimit( $from , $quantityOnPage, $sort)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} ORDER BY {$sort} LIMIT {$from} , {$quantityOnPage}";
        return Db::getInstance()->queryAll($sql);
    }
    public static function getCount()
    {
        $tableName = static::getTableName();
        $sql = "SELECT COUNT(*) as count FROM {$tableName}";
        return Db::getInstance()->queryOne($sql)['count'];
    }

    public function delete()
    {
        $tableName = static ::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return $this->db->execute($sql, [":id" => $this->id]);
    }

    public function insert()
    {
        $params = [];
        $colums = [];

        foreach ($this as $key => $value) {
           if ($key == "db" || $key == "id") continue;
           $colums[] = "`$key`";
           $params[":{$key}"] = $value;
        }

        $colums = implode(", ", $colums);
        $value = implode(", ", array_keys($params));

        $tableName = static :: getTableName();
       $sql = "INSERT INTO {$tableName} ({$colums}) VALUES ({$value})";

       $this->db->execute($sql, $params);

       $this->id = $this->db->lastInsertId();
    }

    public function save()
    {

        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }



    public function update()
    {
        //тут не смог сделать универсальный метод,тобы все подставлялось,поэтому запрос сделаю только для таск
        $tableName = static :: getTableName();
        $params = [];
        foreach ($this as $key => $value) {
            if ($key == "db" ) continue;
            $params[":{$key}"] = $value;
        }

        $sql = "UPDATE {$tableName} SET `username`=:username, `email`=:email, `description`=:description, `status`=:status WHERE id = :id";
        $this->db->execute($sql, $params);
    }



    abstract static public function getTableName();

}