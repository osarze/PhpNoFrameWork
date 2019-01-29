<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Email: osas006@yahoo.com
 * Date: 1/29/2019
 * Time: 4:38 PM
 */

namespace App\Core\View;


use Symfony\Component\HttpFoundation\Response;

interface Renderer
{
    public function render($template, $data = []) : string ;

    public function make($template, $data = []): Response ;
}