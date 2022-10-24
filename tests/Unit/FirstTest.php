<?php

namespace Tests\Unit;

use Tests\TestCase;

class FirstTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        // $this->assertTrue(true);
        // $this->get('/')->assertStatus(200)->assertSeeText('Documentation');
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Documentation');
    }
}
