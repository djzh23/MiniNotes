<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Core\{Request, Response, Router};

final class HttpKernel
{



    public static function handle(Request $req): Response
    {
        $router = new Router();
        $res = new Response();

        // Erste Route registrieren – GET /health → "OK" ( mit add und dispatch)
        $router->add('GET', '/health', fn(Request $r, Response $res) => $res->html('OK', 200));
        return $router->dispatch($req, $res);
    }
}
