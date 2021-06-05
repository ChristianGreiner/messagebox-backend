@extends('layouts.default')

@section('pretitle', 'Settings')
@section('title', 'Device')

@section('page')

<!-- Alerts -->
@includeWhen(session('success'), 'components.alert', ['type' => 'success', 'message' => session('success')])

<div class="row gx-lg-4">
    @include('settings.navigation')
    <div class="col-sm-9">
        <div class="card">
            <form method="POST" action="{{ route('settings.device.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="row">
                            <span class="col">
                                <h3 class="card-title">Behaviour</h3>
                                <div class="card-subtitle">Set the behaviour of your device.</div>
                            </span>
                        </label>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Rotation</label>
                                <small class="form-hint">How often should your device rotate when you have received a new message?</small>
                            </div>
                            <div class="col-auto ms-auto d-flex align-items-center">
                                <input class="form-control text-center py-1" type="number" name="rotation_count" min="1" max="3" value="{{ auth()->user()->rotation_count }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Polling</label>
                                <small class="form-hint">How often (in seconds) should your device check for a new message?</small>
                            </div>
                            <div class="col-auto ms-auto d-flex align-items-center">
                                <input class="form-control text-center py-1" type="number" name="fetch_interval" min="60" max="3600" value="{{ auth()->user()->fetch_interval }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Rotation Interval</label>
                                <small class="form-hint">At what time interval (seconds) should the device rotate??</small>
                            </div>
                            <div class="col-auto ms-auto d-flex align-items-center">
                                <input class="form-control text-center py-1" type="number" name="rotation_interval" min="30" max="120" value="{{ auth()->user()->rotation_interval }}">
                            </div>
                        </div>
                    </div>
                    <!--<div class="row">
                        <label class="row">
                            <span class="col">
                                <h3 class="card-title">Do Not Disturb</h3>
                                <div class="card-subtitle">Disable notifications at certain times</div>
                            </span>
                            <span class="col-auto">
                                <label class="form-check form-check-single form-switch">
                                    <input class="form-check-input" name="no_disturbance_enabled" step="5" type="checkbox">
                                </label>
                            </span>
                        </label>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">From</label>
                            <div class="col-auto ms-auto">
                                <div class="row g-12">
                                    <div class="col-12">
                                        <input class="form-input" type="time" name="no_disturbance_from" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label mr-auto">To</label>
                            <div class="col-auto ms-auto">
                                <div class="row g-12">
                                    <div class="col-612">
                                        <input class="form-input" type="time" name="no_disturbance_to" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
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