@extends('layouts.default')

@section('pretitle', 'Device')
@section('title', 'Add Device')

@section('page')
<div class="col-md-12">
    <div class="card mb-3">
        <div class="card-status-start bg-primary"></div>
        <div class="card-body">
            <p>When your Device is not connected to an account, it should show a unique hardware ID on its display.</p>
        </div>
    </div>
    <div class="card">
        <form method="POST" action="{{ route('device.store') }}">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Hardware ID</label>
                        <input type="text" class="form-control @if ($errors->any()) is-invalid @endif" name="hardware_id" value="{{ old('hardware_id') }}" maxlength="9" required autofocus />
                        @if ($errors->any())
                            <div class="invalid-feedback">{{ $errors->first() }}</div>
                        @endif
                        <small class="form-hint">Your Hardware ID must be 9 characters long.</small>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-link">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
