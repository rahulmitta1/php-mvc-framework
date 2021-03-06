<?php

namespace ramit\phpmvc;

use ramit\phpmvc\middlewares\BaseMiddleware;

/**
 * Class Controller
 * 
 * @package ramit\phpmvc
 */

class Controller
{
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function render($view, $params = [])
    {
        return Application::$app->view->renderContent($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
