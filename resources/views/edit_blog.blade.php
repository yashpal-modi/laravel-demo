@include("files")

@extends('layout')

@section('content')

<main class="login-form">
   <div class="cotainer">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header">
                  Edit Post
                  <div style="float:right">
                     <a class="btn btn-warning" href="{{ route('post.index') }}">Back</a>
                  </div>
               </div>
               <div class="card-body">
                  <form id="post_form" action="{{ route('post.update', $post->id) }}" method="POST">
                     @csrf
                     @method('PUT')
                     <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Title<span class="lbl-str">*</span></label>
                        <div class="col-md-6">
                           <input type="text" id="title" class="form-control" value="{{$post->title}}" name="title" autofocus>
                           @if ($errors->has('title'))
                           <span class="text-danger">{{ $errors->first('title') }}</span>
                           @endif
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description<span class="lbl-str">*</span></label>
                        <div class="col-md-6">
                           <textarea id="description" class="form-control" name="description" rows="4" cols="50" autofocus>{{$post->description}}
                           </textarea>
                           <label id="messageBox"></label>
                           @if ($errors->has('description'))
                           <span class="text-danger">{{ $errors->first('description') }}</span>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                        Update Post
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
   //Form Validation
   $(document).ready(function() {
       $("#post_form").validate({
           ignore: ".ignore",
           rules: {
               title:{
                   required: true,
                   minlength: 3
               },
               description:{
                   required: true,
               },
           },
           messages: {
               title: {
                   required: "Please enter title",
                   minlength: "Title should be atleast 3 character long",
               },
               description: {
                   required: "Please enter description",
               }, 
           },
       });
   });
</script>