<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 5/1/2018
 * Time: 5:17 AM
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View\Renderer;
use App\Core\View22;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index()
    {
        $this->response->setContent($this->renderer->render('home.html'));
        $this->response->send();
    }
}