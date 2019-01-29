<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Email: osas006@yahoo.com
 * Date: 1/29/2019
 * Time: 2:55 PM
 */
return [
    ['GET', '/', ['App\Controllers\HomeController', 'index']],
    ['POST', '/hello', function ($name) {
        echo 'Hello World';
    }],
    ['GET', '/route', function () {
        echo 'This works too';
    }]
];