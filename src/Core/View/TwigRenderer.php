<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Email: osas006@yahoo.com
 * Date: 1/29/2019
 * Time: 4:39 PM
 */

namespace App\Core\View;


use Symfony\Component\HttpFoundation\Response;

class TwigRenderer implements Renderer
{
    private $renderer;
    private $response;

    public function __construct(\Twig_Environment $twig_Environment, Response $response)
    {
        $this->renderer = $twig_Environment;
        $this->response = $response;
    }

    public function render($template, $data = []): string
    {
        return $this->renderer->render($template, $data);
    }

    public function make($template, $data = []): Response
    {
        $this->response->setContent($this->render($template, $data = []));
        return $this->response->send();
    }


}