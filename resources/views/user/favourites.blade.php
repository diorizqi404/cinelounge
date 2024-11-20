<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineLounge | Favourites</title>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/favourite.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    @include('components.nav-welcome')


    <section class="movie" id="movie">
        <div class="container-movie">
            <ul class="list">
                @foreach ($favourites as $fav)
                    <li>
                        <a href="{{ route('films.show', $fav->film->slug) }}">
                            <img src="{{ asset('images/' . $fav->film->image) }}" alt="{{ $fav->film->title }}">
                            <p style="color: white; font-weight: 500;">{{ $fav->film->title }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <div class="pagination mt-16 flex justify-center">
        {{ $favourites->links('components.pagination') }}
    </div>
    <script type="text/javascript">
        const menu = document.querySelector(".menu");
        const menuBtn = document.querySelector(".menu-btn");

        menuBtn.addEventListener("click", () => {
            menu.classList.toggle("menu-open");
            if (menu.classList.contains("menu-open")) {
                menuBtn.firstElementChild.classList.replace('bx-menu', 'bx-x');
            } else {
                menuBtn.firstElementChild.classList.replace('bx-x', 'bx-menu');
            }
        });

        function togglemenu() {
            var wrapper = document.getElementById("user-wrapper");
            wrapper.classList.toggle("open-class");
        }
    </script>
</body>

</html>
