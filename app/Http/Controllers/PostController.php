<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        // validation checking
        $validation = Validator::make($request->all(),[
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|min:50|max:1000'
        ]);

        // dd($request->all());

        // if ($validation->fails()) {
        //     return Redirect::back()->withErrors($validation)->withInput();
        // }

        $data = [
            'user_id' => auth()->user()->id,
            'post_title' => $request->title,
            'post_body' => $request->description
        ];

        Post::insert($data);

        return Redirect::to('home');
    }
}
