<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
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
            'dob'  => '05/14/1988'
        ] );

        $authors = Author::all();
        $this->assertCount( 1, $authors );
        $this->assertInstanceOf( Carbon::class, $authors->first()->dob );
        $this->assertEquals('1988/05/14', $authors->first()->dob->format('Y/m/d') );
    }
}
