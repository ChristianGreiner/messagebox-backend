@extends('layouts.app')

@section('body')

<body class="antialiased">
    <div class="page">
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ route('messages') }}">
                        Messagebox
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown d-flex me-3">
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="mute" @if(auth()->user()->mute) checked @endif class="form-selectgroup-input" id="mute-checkbox">
                            <span class="form-selectgroup-label">
                                <svg xmlns="http://www.w3.org/2000/svg" id="bell-icon-on" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="3" x2="21" y2="21" /><path d="M17 17h-13a4 4 0 0 0 2 -3v-3a7 7 0 0 1 1.279 -3.716m2.072 -1.934c.209 -.127 .425 -.244 .649 -.35a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                            </span>
                        </label>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <div class="d-xl-block ps-2">
                                <span class="avatar avatar-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                </span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                                @csrf
                                <button class="border-0 p-0 w-100" style="background-color: transparent; text-align: left; outline: none;">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @include('layouts.navigation')
        <div class="content">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                @yield('pretitle')
                            </div>
                            <!-- Page title -->
                            <h2 class="page-title">
                                @yield('title')
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        @yield('title-actions')
                    </div>
                </div>
                @yield('page')
            </div>
        </div>
    </div>
</body>

<style>
.form-selectgroup-input:checked+.form-selectgroup-label {
    color: #d63939;
    background: rgba(32,107,196,.01);
    border-color: #90b5e2;
}
</style>
@endsection