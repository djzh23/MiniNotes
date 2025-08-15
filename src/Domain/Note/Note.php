<?php

declare(strict_types=1);

namespace App\Domain\Note;

final class Note
{

    public function __construct(public ?int $id, public string $title, public string $body) {}

    public function id(): ?int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
