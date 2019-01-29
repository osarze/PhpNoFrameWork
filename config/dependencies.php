<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Email: osas006@yahoo.com
 * Date: 1/28/2019
 * Time: 3:05 PM
 */


return [
    Swift_Mailer::class => DI\factory(function () {
        $transport = (new Swift_SmtpTransport(config('mail.host'), config('mail.port')))
            ->setUsername(config('mail.username'))
            ->setPassword(config('mail.password'));

        return new Swift_Mailer($transport);

    }),
    Psr\Log\LoggerInterface::class => DI\factory(function (\Psr\Container\ContainerInterface $container){

        $formatter = new \Monolog\Formatter\LineFormatter();
        $formatter->allowInlineLineBreaks(true);

        $logger = new \Monolog\Logger(config('app.env'));
        $fileHandler = new \Monolog\Handler\StreamHandler(__DIR__ . '/../logs/app.log', \Monolog\Logger::DEBUG);

        $fileHandler->setFormatter($formatter);
        $logger->pushHandler($fileHandler);

        if(config('app.env') === 'production'){
            $mailer = $container->get('Swift_Mailer');
            $message = new \Swift_Message();
            $message->setSubject('Error On ' . config('app.name'))
                ->setFrom(['error@creativeyard.tech' => 'Error Report'])
                ->setTo(['osas@yahoo.com' => 'Emmanuel O.'])
                ->setContentType('text/html');

            $mailHandler = new \Monolog\Handler\SwiftMailerHandler($mailer, $message, \Monolog\Logger::DEBUG);
            $mailHandler->setFormatter(new \Monolog\Formatter\HtmlFormatter());
            $logger->pushHandler($mailHandler);
        }

        return $logger;
    }),
    Symfony\Component\HttpFoundation\Request::class => Symfony\Component\HttpFoundation\Request::createFromGlobals(),

    Symfony\Component\HttpFoundation\Response::class => new Symfony\Component\HttpFoundation\Response(),

    Twig_Environment::class => DI\factory(function (){
        $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '\views');
        $twig = new Twig_Environment($loader);

//        $function = new \Twig_Function('base_uri', 'base_uri');
//        $twig->addFunction($function);
//        $function = new \Twig_Function('asset_url', 'asset_url');
//        $twig->addFunction($function);
//        $function = new \Twig_Function('url', 'url');
//        $twig->addFunction($function);
//
//        $function = new \Twig_Function('env', 'env');
//        $twig->addFunction($function);

        return $twig;
    }),
    \App\Core\View\Renderer::class => \Di\factory(function (\Psr\Container\ContainerInterface $container){
        $twigEnvironment = $container->get('Twig_Environment');
        $response = $container->get('Symfony\Component\HttpFoundation\Response');
        return new \App\Core\View\TwigRenderer($twigEnvironment, $response);
    })


//    DI\create('App\Books')->constructor(\DI\create('App\User')->constructor(\DI\create('App\NestedDependency')))
//    \App\Books::class => \DI\factory(function (\Psr\Container\ContainerInterface $container) {
//         return $container->get('App\User');
//        return new \App\Books(new \App\User(new App\NestedDependency()));
//    })
];