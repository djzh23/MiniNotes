<?php

declare(strict_types=1);

namespace App\Infrastructure\Note;

use App\Domain\Note\Note;
use App\Domain\Note\Contracts\INoteRepository;

final class InMemoryNoteRepository implements INoteRepository
{

    // Konstruktor: Session-Start und kommt im Front Controller
    public function __construct()
    {
        $_SESSION['notes'] ??= [new Note(1, 'First Note', '...'), new Note(2, 'Second Note', '...')];
        $_SESSION['notes_next_id'] ??= 3;
    }
    public function all(): array
    {
        return $_SESSION['notes'];
    }


    public function create(Note $note): Note
    {
        $note =  new Note($_SESSION['notes_next_id']++, $note->getTitle(), $note->getBody());
        $_SESSION['notes'][] = $note;
        return $note;
    }

    public function delete(int $id): bool
    {

        $before = count($_SESSION['notes']);
        $_SESSION['notes'] = array_values(array_filter($_SESSION['notes'], fn($n) => $n->id !== $id));
        return count($_SESSION['notes']) < $before;
    }
}
