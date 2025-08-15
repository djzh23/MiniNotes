<?php

declare(strict_types=1);

namespace App\Core;

final class Response
{

    public int $code = 200;
    public string $body = '';

    public function html(string $s, int $code = 200): self
    {
        $this->code = $code;
        $this->body = $s;
        return $this;
    }

    public function redirect(string $to): self
    {
        header('Location: ' . $to, true, 302);
        $this->code = 302;
        $this->body = '';
        return $this;
    }
}
