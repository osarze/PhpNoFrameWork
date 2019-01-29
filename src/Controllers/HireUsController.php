<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 12/10/2018
 * Time: 10:51 AM
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Core\View22;

class HireUsController extends Controller
{
    public function indexAction(){
        $view = $this->renderer->render('hire-us.html', [
            'pageHeader' => 'Request A Quote',
            'background' => 'about-banner'
        ]);
        $this->response->setContent($view);
        $this->response->send();
    }
}