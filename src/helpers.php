<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Email: osas006@yahoo.com
 * Date: 1/28/2019
 * Time: 2:18 PM
 */
function config($key, $default=null){
    $config = \Gestalt\Configuration::load(new Gestalt\Loaders\PhpDirectoryLoader(__DIR__ . '/../config'));
    return $config->get($key, $default);
}

//function env($key){
//
//}