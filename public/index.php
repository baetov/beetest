<?php
session_start();
use app\engine\Autoload;
use app\engine\Request;
use app\engine\RequestException;

include "../config/config.php";
//include "../engine/Autoload.php";
include "../vendor/autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);
try {
    $request = new Request();


    $controllerName = $request->getControllerName() ?: 'tasks';
    $actionName = $request->getActionName();

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new \app\engine\Render());
        $controller->runAction($actionName);
    }
     else {
         throw new RequestException("Не верный контроллер");
     }

} catch (\PDOException $e) {
    echo "Ошибка БД";

} catch (RequestException $e) {
    echo($e->getMessage());
    var_dump($e->getTrace());

} catch (\Exception $e) {
    echo($e->getMessage());
    var_dump($e->getTrace());
}

