<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with(['images'])
        ->where([
            ['user_id', auth()->user()->id]
        ])
        ->orderBy('id', 'DESC')
        ->get();

        // dd($posts[0]->images->first()->image_name);

        return view('home')->with([
            'posts' => $posts
        ]);
    }
}
