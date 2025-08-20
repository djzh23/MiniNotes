<?php

declare(strict_types=1);

namespace App\Infrastructure\Note;

use App\Domain\Note\Contracts\INoteRepository;
use App\Domain\Note\Note;
use LogicException;
use PDO;

final class PdoNoteRepository implements INoteRepository
{
    public function __construct(private PDO $pdo, private string $table) {}

    public function all(): array
    {
        // throw new LogicException('NI');
        $sql  = "SELECT id, title, body FROM {$this->table} ORDER BY id";
        $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($r) => new Note((int)$r['id'], (string)$r['title'], (string)$r['body']), $rows);
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
