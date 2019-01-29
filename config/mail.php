<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Email: osas006@yahoo.com
 * Date: 1/28/2019
 * Time: 7:03 PM
 */
return [
    'driver' => getenv('MAIL_DRIVER'),
    'host' => getenv('MAIL_HOST'),
    'port' => getenv('MAIL_PORT'),
    'username' => getenv('MAIL_USERNAME'),
    'password' => getenv('MAIL_PASSWORD')
];