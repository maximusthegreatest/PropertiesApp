<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Property;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $slug
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $slug)
    {

        $property = Property::where('slug', $slug)->firstOrFail();

        $user = auth()->user()->id;

        $body = $request->validate(['body' => 'required']);

        $comment = new Comment();
        $comment->owner_id = $user;
        $comment->property_id = $property->id;
        $comment->body = $request->body;

        $comment->save();
        return redirect("/properties/" . $slug);
    }
}
