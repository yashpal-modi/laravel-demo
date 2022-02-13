<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Session;
use Hash;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $posts = User::find($userId)->post()->paginate(10);
        return view('blog', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_blog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $userId = auth()->user()->id;
        $user = User::find($userId);
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;

        if($user->post()->save($post)){
            return redirect()->route('post.index')
                ->with('flash_message', 'Blog has been created succssfully.')
                ->with('flash_type', 'alert-success');
        }else{
            return back()
                ->with('flash_message', 'Error while creating blog.')
                ->with('flash_type', 'alert-error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = auth()->user()->id;
        $post = Post::find($id);
        if($post){
            $getPostUserId = $post->user_id;
            if($getPostUserId == $userId){
                return view('show_blog',compact('post'));
            }else{
                return redirect()->route('post.index')
                    ->with('flash_message', 'You are not allow to access')
                    ->with('flash_type', 'alert-error');
            }
        }else{
            return redirect()->route('post.index')
                    ->with('flash_message', 'Data not found')
                    ->with('flash_type', 'alert-error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = auth()->user()->id;
        $post = Post::find($id);
        if($post){
            $getPostUserId = $post->user_id;
            if($getPostUserId == $userId){
                return view('edit_blog',compact('post'));
            }else{
                return redirect()->route('post.index')
                    ->with('flash_message', 'You are not allow to access')
                    ->with('flash_type', 'alert-error');
            }
        }else{
            return redirect()->route('post.index')
                    ->with('flash_message', 'Data not found')
                    ->with('flash_type', 'alert-error');
        }
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
        $updateData = $request->validate([
                        'title' => 'required',
                        'description' => 'required',
                    ]);

        $userId = auth()->user()->id;
        $post = Post::find($id);

        if($post){
            $getPostUserId = $post->user_id;
            if($getPostUserId == $userId){
                $updateRecord = Post::where('id', $id)
                                    ->update($updateData);
                    if($updateRecord){
                        return redirect()->route('post.index')
                            ->with('flash_message', 'Blog has been updted succssfully.')
                            ->with('flash_type', 'alert-success');
                    }else{
                        return redirect()->route('post.index')
                                ->with('flash_message', 'Error while updating record')
                                ->with('flash_type', 'alert-error');
                    }                                    
            }else{
                return redirect()->route('post.index')
                    ->with('flash_message', 'You are not allow to access')
                    ->with('flash_type', 'alert-error');
            }
        }else{
            return redirect()->route('post.index')
                    ->with('flash_message', 'Data not found')
                    ->with('flash_type', 'alert-error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = auth()->user()->id;
        $post = Post::find($id);
        if($userId == $post->user_id){
            if(Post::destroy($id)){
                return redirect()->route('post.index')
                    ->with('flash_message', 'Blog has been deleted succssfully.')
                    ->with('flash_type', 'alert-success');
            }else{
                return back()
                    ->with('flash_message', 'Error while deleting blog.')
                    ->with('flash_type', 'alert-error');
            }
        }else{
            return redirect()->route('post.index')
                ->with('flash_message', 'You are not allow to access')
                ->with('flash_type', 'alert-error');            
        }
    }
}