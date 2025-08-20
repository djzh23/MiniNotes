<?php

declare(strict_types=1);

namespace App\Infrastructure\Note;

use App\Domain\Note\Contracts\INoteRepository;
use App\Domain\Note\Note;

final class CsvNoteRepository implements INoteRepository
{

    public function __construct(private string $file) {}

    public function all(): array
    {
        // read notes.csv File 
        return array_map(fn($r) => new Note((int)$r[0], (string)$r[1], ((string)$r[2])), $this->readRows());
    }

    public function create(Note $note): Note
    {
        $rows = $this->readRows();
        $nextId = empty($rows) ? 1 : max(array_map(fn($r) => (int)$r[0], $rows)) + 1;
        $rows[] = [$nextId, $note->getTitle(), $note->getBody()];
        $this->writeRows($rows);
        return new Note($nextId, $note->getTitle(), $note->getBody());
    }

    public function delete(int $id): bool
    {
        $rows = $this->readRows();
        $n = count($rows);
        $rows = array_values(array_filter($rows, fn($r) => (int)$r[0] !== $id));
        $this->writeRows($rows);
        return count($rows) < $n;
    }

    private function ensure(): void
    {
        if (!is_file($this->file)) {
            touch($this->file);
        }
    }

    private function readRows(): array
    {
        $this->ensure();
        $rows = [];
        if (($h = fopen($this->file, 'r')) !== false) {
            while (($r = fgetcsv($h, 0, ';')) !== false) {
                if ($r !== [null])
                    $rows[] = $r;
            }
            fclose($h);
        }
        return $rows;
    }

    private function writeRows(array $rows): void
    {
        $h = fopen($this->file, 'w');
        foreach ($rows as $r)
            fputcsv($h, $r, ';');
        fclose($h);
    }
}
