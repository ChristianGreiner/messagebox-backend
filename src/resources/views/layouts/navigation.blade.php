<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item nav-item dropdown @if (request()->routeIs('messages*')) active @endif">
                        <a class="nav-link" href="{{ route('messages') }}">
                            <span class="nav-link-title">
                                Messages
                            </span>
                        </a>
                    </li>
                    <li class="nav-item @if (request()->routeIs('friends.*')) active @endif">
                        <a class="nav-link" href="{{ route('friends.index') }}">
                            <span class="nav-link-title">
                                Friends
                                @if (auth()->user()->friendRequests()->count() > 0)
                                    <span class="badge bg-red">{{ auth()->user()->friendRequests()->count() }}</span>
                                @endif
                            </span>
                        </a>
                    </li>
                    <li class="nav-item @if (request()->routeIs('device.*')) active @endif">
                        <a class="nav-link" href="{{ route('device.index') }}">
                            <span class="nav-link-title">
                                Device
                            </span>
                        </a>
                    </li>
                    <li class="nav-item @if (request()->routeIs('settings.*')) active @endif">
                        <a class="nav-link" href="{{ route('settings.profile') }}">
                            <span class="nav-link-title">
                                Settings
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
