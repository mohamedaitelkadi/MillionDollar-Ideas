@extends('layout')
@section('content')
<main class="signup-form">
    <div class="cotainer">
    <div class="row d-flex justify-content-center align-items-center">
            <img src="/milli.png" alt="" style="width:50%">
            <!-- <h1 class="text-light text-center" style="width:80%">Million Dollar Ideas</h1> -->
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center bg-dark text-light">Register User</h3>
                    <div class="card-body bg-dark">
                        <form action="{{ route('postsignup') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="First name" id="firstname" class="form-control" name="firstname" autofocus>
                                @if ($errors->has('firstname'))
                                <span class="text-danger">{{ $errors->first('firstname') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Last name" id="lastname" class="form-control" name="lastname" autofocus>
                                @if ($errors->has('lastname'))
                                <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Username" id="username" class="form-control" name="username" autofocus>
                                @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-outline-light btn-block" >Sign up</button>
                            </div>
                            <div class="form-group mt-3 text-light">
                                <div >
                                    <label>You already have an account? <a href="{{ route('login') }}">Sign in</a></label>
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