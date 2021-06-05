@extends('layouts.default')

@section('pretitle', 'Device')
@section('title', 'Your Device')

@section('page')

    <!-- Alerts -->
    @includeWhen(session('success'), 'components.alert', ['type' => 'success', 'message' => session('success')])

    @if ($device)
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-status-top @if($device->registered) bg-green @else bg-yellow @endif"></div>
                    <div class="card-body">
                        <h3 class="card-title">Device: {{ $device->hardware_id }}</h3>
                        @if($device->registered) 
                            <p>Perfect! Your device is registered and can receive messages.</p>
                        @else
                            <p>You device is registered. Waiting for connection.</p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="#" class="btn btn-danger ms-auto" data-bs-toggle="modal" data-bs-target="#modal-simple">
                                Remove Device
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container-xl d-flex flex-column justify-content-center">
            <div class="empty">
                <div class="empty-img"><img src="{{ asset('images/undraw_manage_chats.svg') }}"
                        style="height: 250px !important;">
                </div>
                <p class="empty-title">No Device registered</p>
                <p class="empty-subtitle text-muted">
                    You need to register your device to receive messages.
                </p>
                <div class="empty-action">
                    <a href="{{ route('device.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add your device
                    </a>
                </div>
            </div>
        </div>
    @endif
    @if ($device)
    <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('device.destroy', $device->hardware_id) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Remove Device</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove this device from your account?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('scripts')
<script>

    var device = {!! json_encode($device) !!};

    document.addEventListener("DOMContentLoaded", function(event) {
        var reloading = sessionStorage.getItem("reloading");
        if (reloading === null || reloading == true) {
            setInterval(function() {
                const response = Messagebox.check_device_status();
                response.then((data) => {
                    if (data) {
                        if (data.registered == 1) {
                            sessionStorage.setItem("reloading", "false");
                            location.reload();
                        } else {
                            sessionStorage.setItem("reloading", "true");
                        }
                    }
                });
            }, 5000);
        }

    });
    
</script>
@endsection