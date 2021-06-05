@extends('layouts.default')

@section('pretitle', 'Messages')
@section('title', 'Your Messages')

@section('title-actions')
<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        @if(auth()->user()->friends()->count() > 0)
            <a href="{{ route('messages.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                New Message
            </a>
            <a href="{{ route('messages.create') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new message">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </a>
        @endif
    </div>
</div>
@endsection

@section('page')

    <!-- Alerts -->
    @includeWhen(session('success'), 'components.alert', ['type' => 'success', 'message' => session('success')])

    <div class="col-md-12 mb-2">
        <div class="btn-group w-100">
            <a href="{{ route('messages', ['type' => 'received']) }}" class="btn w-100 {{ $type == 'received'  ? 'btn-primary' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="2" /><path d="M4 13h3l3 3h4l3 -3h3" /></svg>
                Received
            </a>
            <a href="{{ route('messages', ['type' => 'sent']) }}" class="btn w-100 {{ $type == 'sent'  ? 'btn-primary' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="10" y1="14" x2="21" y2="3" /><path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                Sent
            </a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                @if (count($messages) > 0)
                    <div class="divide-y-4">
                        @foreach($messages as $message)
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">
                                            {{ $message->author()->first()->initials }}
                                            @if($message->read)
                                                <span class="badge bg-green"></span>
                                            @else
                                                <span class="badge bg-red"></span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col">
                                        <span class="text-muted d-block text-truncate"><strong>{{ $message->author()->first()->name }}</strong> <span class="subheader">&#8226;</span> {{ $message->createdDate() }}</span>
                                        <div class="text-body mt-n1 @if(!$message->read && $type == 'received') blurred-text @endif">{{{ $message->text }}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('messages.create', ['to' => $message->author()->first()->email]) }}" class="btn btn-white px-2" title="Reply">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="container-xl d-flex flex-column justify-content-center">
                        <div class="empty">
                            <div class="empty-img">
                                <img src="{{ asset('images/undraw_empty_xct9.png') }}" style="height: auto !important;"/>
                            </div>
                            <p class="empty-title">No Messages right now</p>
                            <p class="empty-subtitle text-muted">
                                Send a message by taping 'New Message' to surprise someone.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex mt-4 justify-content-center">
            {{ $messages->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@section('style')
    <style>
        .blurred-text {
            filter:blur(3px);
        }
        .blurred-text:hover {
            filter:blur(0px);
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('js/pulltorefresh.min.js') }}"></script>  
    <script>
        const ptr = PullToRefresh.init({
            mainElement: '.content',
            onRefresh() {
                window.location.reload();
            }
        });
    </script>
@endsection
