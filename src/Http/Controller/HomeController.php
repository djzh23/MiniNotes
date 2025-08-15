<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Core\{Request, Response, View};

final class HomeController extends Controller
{
    public function index(Request $req, Response $res): Response
    {
        return $this->render(new View(), 'home', ['title' => 'MiniNotes']);
    }
}
