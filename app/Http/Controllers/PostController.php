<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\PostCreated;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $posts = Post::where('user_id',$user->id)->get();
        // dd($user->id, $posts);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title'         => 'required',
            'description'   => 'required'
        );

        $niceNames = array(
            'title'         => 'Title',
            'description'   => 'Description'
        );

        $validator = Validator::make($request->all(), $rules);

        $validator->setAttributeNames($niceNames);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        $post = new Post;
        $post->post_title = $request->title;
        $post->post_content = $request->description;
        $post->status = 1;
        $post->user_id = $user->id;
        $post->save();
        
        $post_data = ['title' => $post->post_title, 'content' => $post->post_content, 'user_id' => $post->user_id];
        event(new PostCreated($post_data));

        session()->flash('success','Post Created Successfully!');
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $post = Post::where(['user_id' => $user->id, 'id' => $id])->first();
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'title'         => 'required',
            'description'   => 'required'
        );

        $niceNames = array(
            'title'         => 'Title',
            'description'   => 'Description'
        );

        $validator = Validator::make($request->all(), $rules);

        $validator->setAttributeNames($niceNames);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        $post = Post::where(['user_id' => $user->id, 'id' => $id])->first();
        $post->post_title = $request->title;
        $post->post_content = $request->description;
        $post->update();
        session()->flash('success','Post Updated Successfully!');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function post_status($id)
    {
        $user = Auth::user();

        $post = Post::where(['user_id' => $user->id, 'id' => $id])->first();
        $post->status = $post->status == 1 ? 0 : 1;
        $post->update();
        session()->flash('success','Post Status Changed Successfully!');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function post_delete($id)
    {
        $user = Auth::user();

        $post = Post::where(['id' => $id, 'user_id' => $user->id])->first();
        $post->delete();
        session()->flash('success','Post Deleted Successfully!');
        return redirect(route('post.index'));
    }
}
