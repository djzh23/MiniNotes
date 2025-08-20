<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Core\{Request, Response, View};


abstract class Controller
{
    protected function render(View $view, string $template, array $data = []): Response
    {
        return (new Response())->html($view->render($template, $data));
    }
}
