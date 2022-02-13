@include("files")

@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">
                      User Blog List
                      <div style="float:right">
                        <a class="btn btn-primary" href="{{ route('post.create') }}">Create Blog</a>
                      </div>
                    </div>
                    <div class="card-body">
                        @if ( Session::has('flash_message') )
                            <div class="alert {{ Session::get('flash_type') }}">
                                <h5>{{ Session::get('flash_message') }}</h5>
                            </div>
                        @endif       
                    </div>
                    <div class="blog-table-div">
                        <table class="table table-bordered">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th width="280px">Action</th>
                            </tr>
                            @if (count($posts) > 0)
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->description}}</td>
                                    <td>
                                        <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                                            <a class="btn btn-info" href="{{ route('post.show',$post->id) }}">Show</a>
                                            <a class="btn btn-primary" href="{{ route('post.edit',$post->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4"><center>No any post found</center></td>
                                </tr>
                            @endif
                            </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $posts->links() !!}
                    </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection