<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    # this will save the image to the public folder inside the laravel app
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(){
        $all_posts = $this->post->latest()->get();

        return view('posts.index')
                ->with('all_posts',$all_posts);
    }

    public function create(){
        return view('posts.create');
    }
    
    // public function saveImage($request){
        
    //     $image_name = time(). "." .$request->image->extention();
    //     # 0816.jpg

    //     # save the image inside the storage/app/public/image
    //     $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

    //     return $image_name;
    // }

    public function store(Request $request){
        $request -> validate ([
            'title' => ' required | min:1 | max:50 ',
            'body' => ' required | min:1 | max:1000 ',
            'image' => ' required | mimes: jpg,jpeg,png,gif | max:1000 '
        ]);
        // mimes - multipurpose internet mail extensions

        # Save the request to the DB
        $this->post->user_id            = Auth::user()->id;
        # owner of the post
        $this->post->title              = $request->title;
        $this->post->body               = $request->body;
        //$this->post->image              = $this->saveImage($request);
        $this->post->save();

        # After the post is save the user is routed to the homepage (index)
        return redirect()->route('index');
        # the equivalent of redirect in PHP is header(Location : "file.php")
    }

    public function show($id){
        $post = $this->post->findOrFail($id);

        return view('posts.show')
                ->with('post',$post);
    }

    public function edit($id){
        $post = $this->post->findOrFail($id);

        return view('posts.edit')
                ->with('post',$post);
    }

    public function update(Request $request , $id){

        $request->validate([
            'title' => ' required | min:1 | max:50 ',
            'body'  => ' required | min:1 | max: 1000 ',
            'image' => ' mimes:jpg,jpeg,png,gif | max:1048'
        ]);

        $post           = $this->post->findOrFail($id);
        $post->title      = $request->title;
        $post->body      = $request->body;

        $post->save();
        return redirect()->route('post.show',$id);
    }

    public function destroy($id){
        $post = $this->post->findOrFail($id);

        $this->post->destroy($id);
        return redirect()->route('index');
    }
}
