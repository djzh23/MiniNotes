<?php

declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require __DIR__ . '/../vendor/autoload.php';

//  HttpKernel + Router 
$r = \App\Core\Request::fromGlobals();
$router = new \App\Core\Router();

$res = (new \App\Core\Response())->html("METHOD {$r->method}, PATH {$r->path}");
http_response_code($res->code);
echo $res->body;
