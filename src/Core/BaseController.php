<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Email: osas006@yahoo.com
 * Date: 1/29/2019
 * Time: 3:44 PM
 */

namespace App\Core;


use App\Core\View\Renderer;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
    protected $response;
    protected $template;

    public function __construct(Response $response, Renderer $renderer)
    {
        $this->response = $response;
    }
}