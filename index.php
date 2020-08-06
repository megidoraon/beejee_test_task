<?php

try {
    // автозагрузка классов
    spl_autoload_register(function (string $className) {
        $className = str_replace('\\', '/', $className);
        require_once __DIR__ . '/src/' . $className . '.php';
    });

    $route = $_GET['route'] ?? ''; // параметр запроса указанный в .htaccess
    $routes = require __DIR__ . '/src/routes.php'; // набор роутингов

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \App\Exceptions\NotFoundException();
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);

} catch (\App\Exceptions\DbException $exception) {
    $view = new \App\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('500.php', ['error' => $exception->getMessage()], 500);
} catch (\App\Exceptions\NotFoundException $exception) {
    $view = new \App\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('404.php', ['error' => $exception->getMessage()], 404);
} catch (\App\Exceptions\UnauthorizedException $exception) {
    $view = new \App\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('401.php', ['error' => $exception->getMessage()], 401);
}