@include("files")

@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Register</div>
                  <div class="card-body">
  
                      <form id="reg_form" action="{{ route('register.post') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">First Name<span class="lbl-str">*</span></label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name<span class="lbl-str">*</span></label>
                              <div class="col-md-6">
                                  <input type="text" id="last_name" class="form-control" name="last_name" autofocus>
                                  @if ($errors->has('last_name'))
                                      <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address<span class="lbl-str">*</span></label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password<span class="lbl-str">*</span></label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password">
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                         <div class="form-group row">
                              <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password<span class="lbl-str">*</span></label>
                              <div class="col-md-6">
                                  <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
                                  @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">Birth Date<span class="lbl-str">*</span></label>
                              <div class="col-md-6" id='datetime'>
                                  <input type="text" id="date_of_birth" class="form-control" name="date_of_birth">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  @if ($errors->has('date_of_birth'))
                                      <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="address" class="col-md-4 col-form-label text-md-right">Address<span class="lbl-str">*</span></label>
                              <div class="col-md-6">
                                  <input type="text" id="address" class="form-control" name="address" autofocus>
                                  @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="g-recaptcha-response" class="col-md-4 col-form-label text-md-right">Google Recaptcha<span class="lbl-str">*</span></label>
                              <div class="col-md-6">                 
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Register
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
        $("#reg_form").validate({
            ignore: ".ignore",
            rules: {
                name:{
                    required: true,
                    minlength: 3
                },
                last_name:{
                    required: true,
                    minlength: 3
                },
                email:{
                    required: true,
                    email: true
                },
                password:{
                    required: true,
                    minlength : 6,
                },
                password_confirmation:{
                    required: true,
                    minlength : 6,
                    equalTo : "#password"
                },
                date_of_birth:{
                    required: true
                },
                address:{
                    required: true
                },
                hiddenRecaptcha: {
                    required: function () {
                        if (grecaptcha.getResponse() == '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            },
            messages: {
                name: {
                    required: "Please enter first name",
                    minlength: "First name should be atleast 3 character long",
                },
                last_name: {
                    required: "Please enter last name",
                    minlength: "First name should be atleast 3 character long",
                },
                email:{
                    required: "Please enter email address",
                },
                password: {
                    required: "Please enter password",
                },
                password_confirmation: {
                    required: "Please enter confirm password",
                },
                date_of_birth: {
                    required: "Please enter date of birth",
                },
                address: {
                    required: "Please enter address",
                },
                hiddenRecaptcha:{
                    required: "Please select google captcha",
                }
                
            }
        });
    });

    //Date Picker
    $(function () {
      $('#date_of_birth').datetimepicker({
         format:'DD-MM-YYYY'
      });
    });
</script>