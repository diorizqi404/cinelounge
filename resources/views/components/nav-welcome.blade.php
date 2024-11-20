            @php
                $currentRouteName = Route::currentRouteName();
                $formAction = route($currentRouteName);
            @endphp
<header>
    <nav class="navbar">
        <div class="container">
            <img src="{{ asset('image/logo.png') }}" alt="logo" class="logo">
            <a href="{{ route('welcome') }}" class="brand">CineLounge</a>
            <div class="menu">
                <ul>
                    <li><a href="{{ route('welcome') }}">Home</a></li>
                    <li><a href="{{ route('user.favourites') }}">Favorite</a></li>
                    <li><a href="{{ url('/#contact') }}">Contact</a></li>

                </ul>
            </div>

            <div class="buttons">
                <div class="search">
                    <form action="{{ $formAction }}" method="GET" id="searchForm">
                        <div class="search">
                            <input type="text" name="search" id="find" placeholder="search here..."
                                value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
                <button class="menu-btn">
                    <span class="material-symbols-outlined">
                        <i class='bx bx-menu'></i>
                    </span>
                </button>
                <div class="profil">
                    <span class="material-symbols-outlined">
                        <i class='bx bx-user-circle' class="user-pic" onclick="togglemenu()">
                            <div class="user-wrapper" id="user-wrapper">
                                <div class="user">
                                    <div class="info-user">
                                        @if (Auth::check())
                                            <h3 class="username">Halo, {{ Auth::user()->username }}</h3>
                                        @else
                                            <h3 class="username">Please Login!</h3>
                                        @endif
                                    </div>
                                    @if (Auth::check())
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="logout">
                                                <i class='bx bx-log-in'></i>
                                                <p>Logout</p>
                                            </button>
                                        </form>
                                    @else
                                        <a class="logout" href="{{ route('login') }}">
                                            <i class='bx bx-log-in'></i>
                                            <p>Login</p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </i>
                    </span>
                </div>
            </div>
        </div>
    </nav>
</header>
