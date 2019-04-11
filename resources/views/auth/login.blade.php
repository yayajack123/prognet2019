@extends('layout.layout')
@section('title','Account')
@section('page','Account')
@section('content')
<div class="aa-myaccount-area">         
    <div class="row">
      <div class="col-md-6">
        <div class="aa-myaccount-login">
        <h4>Login</h4>
         <form action="{{ route('login') }}" class="aa-login-form" method="POST">
            @csrf
          <label for="email">Email address<span>*</span></label>
           <input type="text" placeholder="Email" name="email">
           <label for="password">Password<span>*</span></label>
            <input type="password" placeholder="Password" name="password">
            <button type="submit" class="aa-browse-btn">Login</button>
            <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            <p class="aa-lost-password"><a href="/register">Create an Account now !!</a></p>
          </form>
        </div>
      </div>
    </div>          
 </div>
@endsection
    