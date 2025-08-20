<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Application\Note\NoteService;
use App\Core\{Request, Response, Router};
use App\Http\Controller\HealthController;
use App\Http\Controller\HomeController;
use App\Http\Controller\NotesController;
use App\Infrastructure\Note\CsvNoteRepository;
use App\Infrastructure\Note\InMemoryNoteRepository;

final class HttpKernel
{



    public static function handle(Request $req): Response
    {
        $router = new Router();
        $res = new Response();


        $noteRepository_IN_MEMORY = new InMemoryNoteRepository();
        $noteRepository_CSV = new CsvNoteRepository(__DIR__ . '/../Storage/notes.csv');
        // $pdoNoteRepository_DB = new PdoNoteRepository();
        $noteService = new NoteService($noteRepository_CSV);


        // Routen registrieren ( mit add und dispatch) ohne Controller

        // $router->add('GET', '/health', fn(Request $r, Response $res) => $res->html('OK', 200));
        // $router->add('GET', '/', fn(Request $r, Response $res) => $res->html('<h1>MiniNotes</h1>', 200));


        // Routen registrieren ( mit add und dispatch) mit Controller
        $router->add('GET', '/', [new HomeController(), 'index']);
        $router->add('GET', '/health', [new HealthController(), 'status']);
        $router->setNotFound(fn($req, $res) => $res->html((new \App\Core\View())->render('errors/404'), 404));

        // Note Domain : Register Service + Route 
        $router->add('GET', '/notes', [new NotesController($noteService), 'index']);
        $router->add('POST', '/notes', [new NotesController($noteService), 'store']);
        $router->add('GET', '/notes/create', [new NotesController($noteService), 'createForm']);
        $router->add('POST', '/notes/delete', [new NotesController($noteService), 'delete']);

        return $router->dispatch($req, $res);
    }
}
