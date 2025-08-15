<?php

declare(strict_types=1);

namespace App\Domain\Note\Contracts;

interface INoteRepository
{
    /* @return Note[] */
    public function all(): array;
}
