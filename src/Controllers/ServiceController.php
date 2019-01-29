<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 5/2/2018
 * Time: 12:36 AM
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View22;


class ServiceController extends Controller
{
    /**
     * Show the service page
     *
     * @return void
     */
    public function indexAction(){
        $view = $this->renderer->render('service/index.html', [
            'pageHeader' => 'Services Offer',
            'background' => 'service-banner'
        ]);
        $this->response->setContent($view);
        $this->response->send();
    }

    /**
     * Show the ecommerce page
     *
     * @return void
     */
    public function eCommerce(){
        $view = $this->renderer->render('service/e-commerce.html', [
            'pageHeader' => 'Ecommerce / Online Store Development',
            'background' => 'web-application-banner'
        ]);
        $this->response->setContent($view);
        $this->response->send();
    }

    /**
     * Show the web Design page
     *
     * @return void
     */
    public function webDesign(){
        $view = $this->renderer->render('service/web-design.html', [
            'pageHeader' => 'Website Design And Development',
            'background' => 'web-design-banner'
        ]);
        $this->response->setContent($view);
        $this->response->send();
    }

    /**
     * Show the web Design page
     *
     * @return void
     */
    public function webAppDevelopment(){
        $view = $this->renderer->render('service/web-app-development.html', [
            'pageHeader' => 'Web Application Development',
            'background' => 'web-application-banner'
        ]);
        $this->response->setContent($view);
        $this->response->send();
    }

    public function seo(){
        $view = $this->renderer->render('service/seo.html', [
            'pageHeader' => 'Search Engine Optimization (SEO)',
            'background' => 'seo-banner'
        ]);
        $this->response->setContent($view);
        $this->response->send();
    }
}