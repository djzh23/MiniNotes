<?php

declare(strict_types=1);

namespace App\Infrastructure\Note;

use App\Domain\Note\Note;
use App\Domain\Note\Contracts\INoteRepository;

final class InMemoryNoteRepository implements INoteRepository
{
    public function all(): array
    {
        return [new Note(1, 'First Note', 'note note note note')];
    }
}
