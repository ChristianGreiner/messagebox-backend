@extends('layouts.default')

@section('pretitle', 'Settings')
@section('title', 'Profile')

@section('page')

<!-- Alerts -->
@includeWhen(session('success'), 'components.alert', ['type' => 'success', 'message' => session('success')])

<div class="row gx-lg-4">
    @include('settings.navigation')
    <div class="col-sm-9">
        <div class="card">
            <form method="POST" action="{{ route('settings.profile.store') }}">
                @csrf
                <div class="card-body">
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary ms-auto">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection