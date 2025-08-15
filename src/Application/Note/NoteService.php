<?php

declare(strict_types=1);

namespace App\Application\Note;

use App\Domain\Note\Contracts\INoteRepository;

final class NoteService
{
    public function __construct(private INoteRepository $repo)
    {
        /** @return NoteDto[] */
        return array_map(fn($n) => new NoteDto($n->id, $n->title), $this->repo->all());
    }
}
