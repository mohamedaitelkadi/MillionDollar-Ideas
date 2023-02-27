@extends('layout')
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row d-flex justify-content-center align-items-center">
            <img src="/milli.png" alt="" style="width:50%;">
            <div class="col-md-4">
                <div class="card bg-dark">
                    <h3 class="card-header text-center bg-dark text-light">Login</h3>
                    @if(\Session::has('message'))
                        <div class="alert alert-info">
                            {{\Session::get('message')}}
                        </div>
                    @endif
                    <div class="card-body bg-dark">
                    <form method="POST" action="{{ route('postlogin') }}">
                        @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="username" id="username" class="form-control" name="username"
                                    autofocus>
                                    @if($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password">
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-outline-light btn-block">Signin</button>
                            </div>
                            <div class="form-group mt-3 text-light">
                                <div >
                                    <label>New member ? <a href="{{ route('register') }}">Register here</a></label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection