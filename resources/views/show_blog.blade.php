@include("files")

@extends('layout')

@section('content')

<main class="login-form">
   <div class="cotainer">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header">
                  Create Post
                  <div style="float:right">
                     <a class="btn btn-warning" href="{{ route('post.index') }}">Back</a>
                  </div>
               </div>
               <div class="card-body">
                     <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                        <div class="col-md-6">
                           <label class="lbl-val">{{$post->title}}</label>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                        <div class="col-md-6">
                            <label class="lbl-val">{{$post->description}}</label>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection