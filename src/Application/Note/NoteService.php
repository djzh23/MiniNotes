<?php

declare(strict_types=1);

namespace App\Application\Note;

use App\Domain\Note\Contracts\INoteRepository;

final class NoteService
{
    public function __construct(private INoteRepository $repo) {}

    public function list(): array
    {
        /** @return NoteDto[] */
        return array_map(fn($n) => new NoteDto($n->id, $n->title), $this->repo->all());
    }

    public function create(string $title, string $body): NoteDto
    {
        $note = $this->repo->create($title, $body);
        return new NoteDto($note->id, $note->title);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
