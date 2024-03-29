<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->seePageIs('/auth/login');
    }

    public function testBasicExample2()
    {
        $this->visit('/admin')
            ->seePageIs('/admin/auth/login');
    }
}
