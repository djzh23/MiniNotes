<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PdoNoteRepositoryTest extends TestCase
{

    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec('CREATE TABLE notes (id INTEGER PRIMARYKEY AUTOINCREMENT, title TEXT NOT NULL, body TEXT NOT NULL)');
    }

    public function test_all_empty_returns_empty_array(): void
    {
        // Arrange
        $repo = new PdoNoteRepository($this->pdo, 'notes');

        //Act
        $result = $repo->all();

        // ASSERT
        $this->assertSame([], $result);
    }
}
