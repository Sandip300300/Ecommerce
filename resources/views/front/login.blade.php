@extends('front.layout.layout')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a><span class="divider"></span></li>
            <li class="active">Log In</li>
        </ul>
        <h3>Login</h3>
        <div class="well">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal" method="POST" action="{{route('logincheck')}}" >
                @csrf
                <div class="control-group">
                    <label class="control-label" for="input_email">Email<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" id="input_email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input_password">Password<sup>*</sup></label>
                    <div class="controls">
                        <input type="password" id="input_password" name="password" placeholder="password">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" value="Login">
                    </div>
                </div>
            </form>
        </div>
        <h3>Registration</h3>
        <div class="well"  >
            <form class="form-horizontal" action="{{route('user.store')}}" method="POST" >
                @csrf
                <div class="control-group">
                    <label class="control-label" for="fastname">First Name<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" id="fastname" name="fastname" placeholder="First Name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="lastname">Last Name<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" id="lastname" name="lastname" placeholder="Last Name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input_email">Email<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" id="input_email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input_password">Password<sup>*</sup></label>
                    <div class="controls">
                        <input type="password" id="input_password" name="password" placeholder="password">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h3
@endsection
