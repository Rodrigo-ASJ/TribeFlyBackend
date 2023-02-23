<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommitTest extends TestCase
{
    /**
     * A basic test example.
     */

     use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('api/comments');

        $response->assertStatus(200);
    }

    /** @test */
    public function index_returns_all_comments()
    {
        // creamos y guardamos
        Comment::factory()->count(3)->create();
        $expectedComments  = Comment::all();

        // y guardamos la respuesta a comparar
        $response = $this->get('api/comments');

        // verificacion si existe estatus de >=200 o < 300
        $response->assertSuccessful();

        // Count the number of items in the collection.
        $response->assertJsonCount($expectedComments->count());

        //Get the collection of items as a plain array.
        $response->assertJson($expectedComments->toArray());
    }

       /** @test */
       public function test_a_comment_can_be_shown()
       {
           $comments = Comment::factory()->create();

           $response = $this->get("api/comments/{$comments->id}");
           $response->assertStatus(200);
           $response->assertJson($comments->toArray());
       }

          /** @test */
    public function test_a_comment_can_be_updated()
    {
        $comments = Comment::factory()->create();
        $data = [
            'name' => 'newName',
            'email' => 'exapleName@example.com',
            'comment' => 'New quiero viajar a texto texto a lugar'
        ];

        $response = $this->put("api/comments/{$comments->id}", $data);
        $response->assertStatus(200);

        $updatedComments = Comment::find($comments->id);

        $this->assertEquals($data['name'], $updatedComments->name);
        $this->assertEquals($data['email'], $updatedComments->email);
        $this->assertEquals($data['comment'], $updatedComments->comment);

    }

     /** @test */
     public function test_a_comment_can_be_deleted()
     {
         $comment = Comment::factory()->create();
         $response = $this->delete("api/comments/{$comment->id}");
         $response->assertStatus(204);
         $this->assertDatabaseMissing('comments', $comment->toArray());
     }

     /** @test */
    public function test_delete_non_existing_comment()
    {
        $response = $this->delete("api/comments/666");
        $response->assertStatus(404);
        $response->assertExactJson(['No se pudo realizar la peticion, el archivo ya no existe o nunca existio']);
    }

}
