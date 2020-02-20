<?php

namespace app\controllers;


use app\model\Task;
use app\interfaces\IRenderer;
use app\model\Users;

abstract class Controller implements IRenderer
{
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $renderer;

    /**
     * Controller constructor.
     * @param $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }


    public function runAction($action = null) {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        }
        else
            echo "404";
    }
    public function render($template, $params = []) {

            return $this->renderTemplate("layouts/{$this->layout}", [
                'content' => $this->renderTemplate($template, $params),
                'auth' => Users::isAuth(),
                'username' => Users::getUser(),
                'isAdmin' => Users::isAdmin()
            ]);

    }

    public function renderTemplate($template, $params = []) {
        return $this->renderer->renderTemplate($template, $params);
    }
}