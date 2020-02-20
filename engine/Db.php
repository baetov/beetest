<?php
namespace app\engine;
use app\traits\Tsingletone;



class Db
{
    use Tsingletone;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'bee',
        'charset' => 'utf8'
    ];

    private  $connection = null;


    private function getConnection() {

        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->preparePdoString(),
                $this->config['login'],
                $this->config['password']
                );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::ERRMODE_EXCEPTION);
        }


        return $this->connection;
    }


    private function preparePdoString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
            );
    }


    private function query($sql, $params = []) {
        $statement = $this->getConnection()->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public function queryObject($sql, $params, $class) {
        $statement = $this->query($sql, $params);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $statement->fetch();
    }

    public function execute($sql, $params = []) {
        $this->query($sql, $params);
        return true;
    }

    public function queryOne($sql, $param = []) {
        return $this->queryAll($sql, $param)[0];
    }

    public function queryAll($sql, $param = []) {
        return $this->query($sql, $param)->fetchAll();
        //fetchAll() вернет нам в виде ассоциотивного массива результаты запроса
    }

    public function __toString()
    {
        return "Db";
    }

    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }

}