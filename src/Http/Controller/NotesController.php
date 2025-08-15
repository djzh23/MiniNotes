<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Application\Note\NoteService;
use App\Core\{Request, Response, View};

// final class HomeController extends Controller
// {
//     public function index(Request $req, Response $res): Response
//     {
//         return $this->render(new View(), 'home', ['title' => 'MiniNotes']);
//     }
// }

final class NotesController extends Controller
{
    public function __construct(private NoteService $service) {}

    public function index(Request $req, Response $res): Response
    {
        return $this->render(new View(), 'notes/index', ['notes' => $this->service->list()]);
    }

    public function createForm(Request $req, Response $res): Response
    {
        return $this->render(new View(), 'notes/create');
    }

    public function store(Request $req, Response $res): Response
    {
        $title = trim($req->post['title'] ?? '');
        if ($title === '') {
            return $res->redirect('/notes/create');
        }
        $this->service->create($title, (string)($req->post['body'] ?? ''));
        return $res->redirect('/notes'); // PRG
    }

    public function delete(Request $req, Response $res): Response
    {

        $id = (int)($req->post['id'] ?? 0);
        if ($id <= 0) {
            return $res->redirect('/notes');
        }

        $this->service->delete($id);
        session_write_close();
        return $res->redirect('/notes');
    }
}
