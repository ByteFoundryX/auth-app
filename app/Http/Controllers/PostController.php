<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = post::all();
        
        return view('posts.index' , compact('posts'));

    }
}
