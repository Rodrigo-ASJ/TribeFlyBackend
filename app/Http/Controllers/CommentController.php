<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\SaveCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
   * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // devolver todo el modelo Comment
        return Comment::all();
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCommentRequest $request)
    {
        //
        $comment = new Comment();

        $comment->name = $comment->name;
        $comment->email = $comment->email;
        $comment->email_verified_at = $comment->email_verified_at;
        $comment->comment = $comment->comment;
        $comment->save($comment->validated()); //! guardar y realizar validación

        return $comment;
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveCommentRequest $request, Comment $comment)
    {
        //
          $comment->update($comment->validated());
          return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $comment = Comment::find($id);
        if(is_null($comment)){
            return response()->json('No se pudo realizar la peticion, el archivo ya no existe o nunca existio', 404);
        }

        $comment->delete();
        return response()->noContent();
    }
}
