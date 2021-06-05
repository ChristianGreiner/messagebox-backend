@extends('layouts.guest')

@section('page')
<div class="flex-fill d-flex flex-column justify-content-center py-4">
    <div class="container-tight py-6" style="max-width: 30rem;">
        <div class="text-center mb-3">
            <h1>Messagebox</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

       

        <form class="card card-md" method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-2">Login to your account</h2>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-2">
                    <label class="form-label">
						Password
						@if (Route::has('password.request'))
							<span class="form-label-description">
								<a href="{{ route('password.request') }}">I forgot password</a>
							</span>
						@endif
					</label>
                    <div class="input-group ">
                        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" />
                        <span class="form-check-label">Remember me on this device</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </div>
            </div>
        </form>
        <!--<div class="text-center text-muted mt-3">
            Don't have account yet? <a href="./sign-up.html" tabindex="-1">Sign up</a>
        </div>-->
    </div>
    @endsection
