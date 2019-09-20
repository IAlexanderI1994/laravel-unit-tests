<?php

namespace Tests\Feature;

use App\Author;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase {
    /**
     * @test
     */

    use RefreshDatabase;

    public function an_author_can_be_created() {

        $this->withoutExceptionHandling();
        $this->post( '/authors', [
            'name' => 'Alex',
            'dob'  => '1988-05-14'
        ] );
        $this->assertCount( 1, Author::all() );
    }
}
