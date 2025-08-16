<?php

declare(strict_types=1);

use App\Domain\Note\Contracts\INoteRepository;
use App\Domain\Note\Note;

final class PdoNoteRepository implements INoteRepository
{
    public function __construct(private PDO $pdo, private string $table) {}

    public function all(): array
    {
        throw new LogicException('NI');
    }

    public function create(Note $note): Note
    {
        throw new LogicException('NI');
    }

    public function delete(int $id): bool
    {
        throw new LogicException('NI');
    }
}
