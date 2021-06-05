<div class="col-sm-3 mb-3">
    <ul class="nav nav-pills nav-vertical">
        <li class="nav-item">
            <a href="{{ route('settings.profile') }}" class="nav-link @if (request()->routeIs('settings.profile')) active @endif">
                Profile
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('settings.device') }}" class="nav-link @if (request()->routeIs('settings.device')) active @endif">
                Device
            </a>
        </li>
    </ul>
</div>