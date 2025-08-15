<?php

declare(strict_types=1);

namespace App\Domain\Note\Contracts;

use App\Domain\Note\Note;

interface INoteRepository
{
    /* @return Note[] */
    public function all(): array;

    /* @retrun create Note */
    public function create(string $title, string $body): Note;

    /* @return actual Note[] after remove */
    public  function delete(int $id): bool;
}
