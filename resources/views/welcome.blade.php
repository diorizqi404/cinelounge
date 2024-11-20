<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineLounge</title>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            align-items: center;
            background-image: linear-gradient(180deg, black, #530f1c, black);
            min-height: 100vh;
        }
    </style>
    @include('components.nav-welcome')

    <section class="home" id="tampilan">
        <div class="box">
            <img src="{{ asset('image/background_home.webp') }}" alt="">

            <div class="ket">
                <h1>RIBUAN FILM PALING POPULER</h1>
                <p class="deskripsi">CineLounge menawarkan ribuan film populer, dari klasik hingga rilis terbaru.
                    Dengan piihan genre yang beragam dan pembaruan rutin, selalu ada sesuatu yang menarik untuk
                    ditonton kapan saja.
                </p>
                <img src="{{ asset('image/sponsor.webp') }}" alt="">
            </div>
        </div>
    </section>


    <section class="movie" id="movie-section">
        <div class="container-movie">
            <ul class="list">
                @foreach ($films as $film)
                    <li>
                        <a href="{{ route('films.show', $film->slug) }}">
                            <img src="{{ asset('images/' . $film->image) }}" alt="{{ $film->title }}">
                            <p style="color: white; font-weight: 500;">{{ $film->title }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <div class="pagination mt-16 flex justify-center">
        {{ $films->links('components.pagination') }}
    </div>

    <section class="contact" id="contact">
        <div class="wrapper">
            <div class="form">
                <form action="{{ route('forms.store') }}" method="POST">
                    @csrf
                    <h1 class="title">Contact Us</h1>
                    <div class="input-box">
                        <input type="text" name="contact_name" placeholder="Your Name">
                    </div>

                    <div class="input-box">
                        <input type="email" name="contact_email" placeholder="Your Email">
                    </div>

                    <div class="input-box textarea">
                        <textarea name="contact_message" class="input" placeholder="Enter Your Message"></textarea>
                    </div>

                    <input type="submit" class="btn">
                </form>
            </div>
        </div>
    </section>

    <div class="bawah">
        <section class="sabrek" id="sabrek">
            <div class="tengah">
                <h1>Tonton film favoritmu secara gratis tanpa batas!</h1>
                <p>Nikmati hiburan tanpa biaya hanya di CineLounge.</p>
                <a href="#movie" class="btn">Tonton Sekarang!</a>
            </div>
        </section>

        <div class="footer-container">
            <div class="another-container">
                <div class="footer-content">
                    <h2>CineLounge</h2>
                    <ul class="footer-links">
                        <li><a href="{{ route('utility.internet-safety') }}">Internet safety</a></li>
                        <li><a href="{{ route('utility.terms') }}">Term of use</a></li>
                        <li><a href="{{ route('utility.privacy-policy') }}">Privacy policy</a></li>
                        <li><a href="{{ route('utility.helps') }}">Help & support</a></li>
                    </ul>
                </div>

                <div class="social-media">
                    <h3>Follow us</h3>
                    <div class="sosmed-icon">
                        <a href="https://x.com/Cinelounge24"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/cinelounge_2024/"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>CineLounge © 2024 All Rights Reserved</p>
    </footer>
    </div>

    <script type="text/javascript">
        // KE BAGIAN FILM
        document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.getElementById('searchForm');
        searchForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const formAction = searchForm.action + '#movie-section';
            searchForm.action = formAction;
            searchForm.submit();
        });

        if (window.location.hash === '#movie-section') {
            document.getElementById('movie-section').scrollIntoView();
        }
    });

        const navbar = document.querySelector(".navbar");
        const menu = document.querySelector(".menu");
        const menuBtn = document.querySelector(".menu-btn");

        function search() {
            let filter = document.getElementById('find').value.toUpperCase();

            let item = document.querySelectorAll('.list li');

            let l = document.getElementsByTagName('p');

            for (var i = 0; i <= l.length; i++) {
                let a = item[i].getElementsByTagName('p')[0];

                let value = a.innerHTML || a.innerText || a.textContent;

                if (value.toUpperCase().indexOf(filter) > -1) {
                    item[i].style.display = "";
                } else {
                    item[i].style.display = "none";
                }
            }
        }

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
