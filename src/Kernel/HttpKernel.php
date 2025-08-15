<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Core\{Request, Response, Router};
use App\Http\Controller\HealthController;
use App\Http\Controller\HomeController;

final class HttpKernel
{



    public static function handle(Request $req): Response
    {
        $router = new Router();
        $res = new Response();

        // Routen registrieren ( mit add und dispatch) ohne Controller

        // $router->add('GET', '/health', fn(Request $r, Response $res) => $res->html('OK', 200));
        // $router->add('GET', '/', fn(\App\Core\Request $r, \App\Core\Response $res) => $res->html('<h1>MiniNotes</h1>', 200));


        // Routen registrieren ( mit add und dispatch) mit Controller
        $router->add('GET', '/', [new HomeController(), 'index']);
        $router->add('GET', '/health', [new HealthController(), 'status']);
        $router->setNotFound(fn($req, $res) => $res->html((new \App\Core\View())->render('errors/404'), 404));

        return $router->dispatch($req, $res);
    }
}
