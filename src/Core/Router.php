<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $map = []; // METHOD => [ PATH => callable]
    private $notFound = null;

    public function add(string $method, string $path, callable $handler): void
    {
        // KEY = METHOD + PATH -> Handle merhen (Lookup in O(1))
        $this->map[strtoupper($method)][$path] = $handler;
    }

    public function dispatch(Request $req, Response $res): Response
    {
        // Handler nachschlagen. Falls keiner -> 404
        $handler = $this->map[$req->method][$req->path] ?? null;
        return $handler ? $handler($req, $res) : ($this->notFound ? ($this->notFound)($req, $res) : $res->html('Not Found', 404));
    }

    public function setNotFound(callable $handler): void
    {
        $this->notFound = $handler;
    }
}
