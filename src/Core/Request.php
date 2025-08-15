<?php

declare(strict_types=1);

namespace App\Core;

final class Request
{
    public string $method;
    public string $path;
    public array $get = [];
    public array $post = [];

    public static function fromGlobals(): self
    {
        $req = new self;
        $req->method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $req->path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $req->get = $_GET;
        $req->post = $_POST;
        return $req;
    }
}
