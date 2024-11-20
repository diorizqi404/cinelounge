<nav>
    <ul class="sidebar">
        <li onclick=hideSidebar()><a href="#"></a></li>
        <li><a href="{{ route('welcome') }}">Home<span></span><span></span></a></li>
        <li><a href="{{ route('user.favourites') }}">Favorite<span></span><span></span></a></li>
        <li><a href="{{ url('/#contact') }}">Contact<span></span><span></span></a></li>
    </ul>
    <ul>
        <li><a href="{{ route('welcome') }}">CineLounge</a></li>
        <li class="hideOnMobile"><a href="{{ route('welcome') }}">Home</a></li>
        <li class="hideOnMobile"><a href="{{ route('user.favourites') }}">Favorite</a></li>
        <li class="hideOnMobile"><a href="{{ url('/#contact') }}">Contact</a></li>
        <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                    width="30" height="30" viewBox="0 0 24 24"
                    style="fill: rgb(255, 255, 255);transform: msFilter">
                    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                </svg></a></li>
    </ul>
</nav>