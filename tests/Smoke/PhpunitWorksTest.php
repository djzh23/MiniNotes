<?php

use PHPUnit\Framework\TestCase;

final class PhpunitWorksTest extends TestCase
{

    public function test_runs(): void
    {
        $this->expectNotToPerformAssertions();
        // $this->assertTrue(true);
    }
}
