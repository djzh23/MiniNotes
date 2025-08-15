<?php

declare(strict_types=1);

namespace App\Application\Note;

final class NoteDto
{
    public function __construct(public int $id, public string $title) {}
}
