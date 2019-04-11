@extends('layout.layout')
@section('title','Account')
@section('page','Account')
@section('content')
<div class="aa-myaccount-area">         
    <div class="row">
      <div class="col-md-6">
        <div class="aa-myaccount-register">                 
         <h4>Register</h4>
         <form method="POST" action="{{ route('register') }}" class="aa-login-form">
          @csrf
            <label for="name">Name<span>*</span></label>
            <input type="text" id="name" name="name" placeholder="Name">
            <label for="email">Email<span>*</span></label>
            <input type="text" id="email" name="email" placeholder="Email">
            <label for="">Password<span>*</span></label>
            <input type="password" id="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
            <label for="">Confirm Password<span>*</span></label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            <input type="text" name="status" value=NULL hidden="">
            <input type="text" name="profile_image" value=NULL hidden="">
            <button type="submit" class="aa-browse-btn">Register</button>                    
          </form>
        </div>
      </div>
    </div>          
 </div>
@endsection
    