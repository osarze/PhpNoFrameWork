<?php declare(strict_types = 1);

require "../vendor/autoload.php";


$dotenv = \Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();
$dotenv->required('APP_DEBUG')->isBoolean();

/**
 * Instantiate Container
 */
$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions('../config/dependencies.php');
$container = $containerBuilder->build();

$request = $container->get('Symfony\Component\HttpFoundation\Request');
$response = $container->get('Symfony\Component\HttpFoundation\Response');

/**
 * Error Handler
 */
//var_dump(getenv('MAIL_ENCRYPTION'));die();
$whoops = new \Whoops\Run();

if (config('app.debug') === 'true') {
    if (Whoops\Util\Misc::isCommandLine()) {
        $whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
    } else {
        if (Whoops\Util\Misc::isAjaxRequest()) {
            $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
        } else {
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
        }
    }
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
} else {
    $response->setContent('<h2>500 Server Error</h2>');
    $response->setStatusCode(500);
    $response->send();
}

// Whenever error is handled, we log it to the text file
$whoops->pushHandler(new \Whoops\Handler\CallbackHandler(function ($exception, $inspector, $run) use ($container){
    $logger = $container->get(\Psr\Log\LoggerInterface::class);
    $logger->critical($exception->getMessage(), ['exception' => $exception->getTraceAsString()]);
}));
$whoops->register();

/**
 * Routes
 */
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include(__DIR__ . '/../routes/web.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatche($routeDefinitionCallback);
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        $response->send();
        break;

    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        $response->send();
        break;

    case \FastRoute\Dispatcher::FOUND:
        if(is_object($routeInfo[1]) && $routeInfo[1] instanceof \Closure){
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            call_user_func($handler, $vars);
        }else {
            $className = $routeInfo[1][0];
            $method = $routeInfo[1][1];
            $vars = $routeInfo[2];
            $class = $container->get($className);
            $class->$method($vars);
        }

        break;
}
