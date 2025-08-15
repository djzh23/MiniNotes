<?php

declare(strict_types=1);
$env = getenv('APP_ENV') ?: 'dev'; // dev | prod
error_reporting(E_ALL);
ini_set('display_errors', $env === 'dev' ? '1' : '0');
session_start();
require __DIR__ . '/../vendor/autoload.php';


//  HttpKernel + Router 
$r = \App\Core\Request::fromGlobals();
// ohne Kernel
//$router = new \App\Core\Router();
// $res = (new \App\Core\Response())->html("METHOD {$r->method}, PATH {$r->path}");

// über Kernel
$res = (new \App\Kernel\HttpKernel())->handle($r);

http_response_code($res->code);
echo $res->body;
echo "<br><br>";
if (($env ?? 'dev') === 'dev') {
    \dd($r);
}

// exit;
