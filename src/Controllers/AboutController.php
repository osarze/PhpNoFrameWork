<?php declare(strict_types =1);
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 5/2/2018
 * Time: 2:41 AM
 */

namespace App\Controllers;

use App\Core\Controller;

class AboutController extends Controller
{
    public function index(){
        $view = $this->renderer->render('about.html', [
            'pageHeader' => 'About Eaglem Tech',
            'description' => 'We are web geek, team of passionate young minds, tech enthusiast. we pull in our expertise from our different individual field',
            'background'    => 'about-banner'
        ]);

        $this->response->setContent($view);
        $this->response->send();
    }
}