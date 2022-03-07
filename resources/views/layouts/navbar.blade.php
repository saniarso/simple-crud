<div class="navbar navbar-expand-md navbar-light navbar-static">
    <div class="navbar-brand">
        <a href="/home" class="d-inline-block">
            <img src="{{ asset('global_assets/images/logo_light.png') }}" alt="">
        </a>
    </div>

    @if (Route::has('login'))
        @auth
            <div class="d-md-none">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                    <i class="icon-tree5"></i>
                </button>
                <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                    <i class="icon-paragraph-justify3"></i>
                </button>
                <button class="navbar-toggler sidebar-mobile-component-toggle" type="button">
                    <i class="icon-unfold"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                            <i class="icon-paragraph-justify3"></i>
                        </a>
                    </li>
                </ul>

                <span class="badge bg-success my-3 my-md-0 ml-md-3 mr-md-auto">{{ config('custom.role.'.Auth::user()->role) }}</span>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown dropdown-user">
                        <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle"
                            data-toggle="dropdown">
                            <img src="{{ asset('global_assets/images/placeholders/placeholder.jpg') }}"
                                class="rounded-circle mr-2" height="34" alt="">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('users.show', $user = Auth::user()->id) }}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="dropdown-item"><i
                                    class="icon-switch2"></i> {{ 'Logout' }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        @endauth
    @endif
</div>
