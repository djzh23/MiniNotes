<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Core\{Request, Response, View};

final class HealthController extends Controller
{
    public function status(Request $req, Response $res): Response
    {
        // return (new Response())->html('OK');
        return $this->render(new View(), 'health', ['title' => 'Title Health Page']);
    }
}
