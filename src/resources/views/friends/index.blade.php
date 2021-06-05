@extends('layouts.default')

@section('pretitle', 'Friends')
@section('title', 'Your friends')

@section('title-actions')
<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <a href="{{ route('friends.create') }}" class="btn btn-primary d-none d-sm-inline-block">
            Add a Friend
        </a>
        <a href="{{ route('friends.create') }}" class="btn btn-primary d-sm-none btn-icon"  aria-label="Add a friend">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </a>
    </div>
</div>
@endsection

@section('page')

    <!-- Alerts -->
    @includeWhen(session('success'), 'components.alert', ['type' => 'success', 'message' => session('success')])

    @if(count($friendRequests) > 0)
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Friend Requests</h3>
                </div>
                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                    <div class="divide-y-4">
                        @foreach($friendRequests as $request)
                        <div>
                            <div class="row">
                                <div class="col-auto">
                                    <span class="avatar">{{ $request->initials }}</span>
                                </div>
                                <div class="col">
                                    <div class="text-truncate">{{ $request->name }}</div>
                                    <div class="text-muted">{{ $request->email }}</div>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="btn-list flex-nowrap">
                                        <form method="POST" action="{{ route('friends.accept', $request->id) }}">
                                            @csrf
                                            <button type="submit" name="accept" class="btn btn-green">
                                                Accept
                                            </button>
                                            <button type="submit" name="decline" class="btn btn-white">
                                                Decline
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                @if(count($friends))
                    <div class="divide-y-4">
                        @foreach($friends as $friend)
                        <div>
                            <div class="row">
                                <div class="col-auto">
                                    <span class="avatar">{{ $friend->initials }}</span>
                                </div>
                                <div class="col">
                                    <div class="text-truncate">{{ $friend->name }}</div>
                                    <div class="text-muted">{{ $friend->email }}</div>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('messages.create', ['to' => $friend->email]) }}" class="btn btn-white px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" /><line x1="12" y1="12" x2="12" y2="12.01" /><line x1="8" y1="12" x2="8" y2="12.01" /><line x1="16" y1="12" x2="16" y2="12.01" /></svg>
                                        </a>
                                        <a href="#" class="btn btn-red px-2" data-bs-toggle="modal" data-bs-target="#modal-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="container-xl d-flex flex-column justify-content-center">
                        <div class="empty">
                            <div class="empty-img">
                                <img src="{{ asset('images/undraw_social_interaction_cy9i.png') }}" style="height: 250px !important;"/>
                            </div>
                            <p class="empty-title">No Friends added yet</p>
                            <p class="empty-subtitle text-muted">
                                Tap 'Add A Friend' button to add or invite some friends and start messaging.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                        </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Do you really want to remove your friend?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <form method="POST" action="{{ route('friends.destroy', 1) }}">
                            <div class="row">
                                @csrf
                                @method('DELETE')
                                <div class="col">
                                    <a href="#" class="btn btn-white w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-danger w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-0" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="4" y1="7" x2="20" y2="7" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> 
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
