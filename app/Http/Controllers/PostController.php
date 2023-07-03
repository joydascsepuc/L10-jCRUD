<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\getClientOriginalExtension;

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
            'post_body' => 'required|string|min:50|max:1000',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg',
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

        $post = Post::create($data);

        // Upload images
        // Upload Item Images
        if ($request->hasFile('images')) {
            $post_images_data = array();
            foreach($request->file('images') as $key => $file){
                $imageName = 'post-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $directory = public_path('images/posts/');
                // checking if the directory exists
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                $imageUrl = $directory . $imageName;
                $image = Image::make($file)->orientate();
                $width = 600;
                $height = 600;
                $image->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->resizeCanvas($width, $height, 'center', false, '#ffffff');
                $image->save($imageUrl);

                $postImageInput['post_id'] =  $post->id; // Post insert ID
                $postImageInput['image_name'] =  $imageName; // Insert Image Name

                $post_images_data[] = $postImageInput; // Assign to array
            }
            PostImage::insert($post_images_data);
        }

        return Redirect::to('home');
    }

    public function view($id)
    {
        $post = Post::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])
        ->firstOrFail();

        return view('post.edit')->with([
            'post' => $post
        ]);
    }

    public function update(Request $request)
    {
        // validation checking
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer',
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|min:50|max:1000'
        ]);

        // dd($request->all());

        // if ($validation->fails()) {
        //     return Redirect::back()->withErrors($validation)->withInput();
        // }

        $data = [
            'post_title' => $request->title,
            'post_body' => $request->description
        ];

        Post::where([
            ['id', $request->id],
            ['user_id', auth()->user()->id]
        ])
        ->update($data);

        return Redirect::to('home');
    }

    public function destroy($id)
    {
        Post::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])
        ->delete();

        return Redirect::to('home');
    }
}
