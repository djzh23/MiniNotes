<?php

declare(strict_types=1);

namespace App\Domain\Note;

final class Note
{
    public function __construct(public int $id, public string $title, public string $body) {}
}
