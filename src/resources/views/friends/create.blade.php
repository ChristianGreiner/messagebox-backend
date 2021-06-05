@extends('layouts.default')

@section('pretitle', 'Friends')
@section('title', 'Add a friends')

@section('page')
<div class="col-md-12">
    <div class="card">
        <form method="POST" action="{{ route('friends.store') }}">
            <div class="card-body">
                @csrf        
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="text" class="form-control @if ($errors->any()) is-invalid @endif" name="email" placeholder="Email address of your friend..." value="{{ old('email') }}" required autofocus />
                    @if ($errors->any())
                        <div class="invalid-feedback">{{ $errors->first() }}</div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-link">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-auto">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
