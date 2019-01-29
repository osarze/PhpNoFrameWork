<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Email: osas006@yahoo.com
 * Date: 1/29/2019
 * Time: 3:31 PM
 */

namespace App\Controllers;


use App\Core\View\Renderer;

class HomeController
{
    private $viewRender;

    public function __construct(Renderer $renderer)
    {
        $this->viewRender = $renderer;
    }

    public function index(){
        return $this->viewRender->make('home.html', ['variable' => 'lskhdfishfios']);
    }
}