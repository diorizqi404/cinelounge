<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Lounge</title>
    <link rel="stylesheet" href="{{ asset('css/film.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
</head>

<body>
    <style>
        body {
            min-height: 100vh;
            background: url({{ asset('images/' . $film->image_bg) }}) center center/cover no-repeat fixed;
            backdrop-filter: blur(5px);
            font-family: 'Poppins', sans-serif;
        }

        @media (max-width: 768px) {
            body {
                background-position: top;
            }
        }
    </style>
    @include('components.nav')
    <div class="banner">
        <div class="content active">
            <h1>{{ $film->title }}</h1>
            <h4>
                <span>{{ $film->release_year }}</span><span><i>{{ $film->age_rate }}+</i></span><span>{{ $film->duration }}</span>
            </h4>
            <p>
                {{ $film->description }}
            </p>
            <h4>Genre: {{ $film->genre }}</h4>
            <div class="flex mt-8">
                {{-- <a href="#" onclick="toggleVideo();"><i class='bx bx-play'></i> Lihat</a> --}}
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="flex items-center text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-3 text-center mr-4"
                    type="button">
                    <span class="material-symbols-rounded mr-2">
                        play_circle
                    </span>
                    Tonton Trailer
                </button>
                <form action="{{  route('films.favourites', $film->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-3 text-center">
                        <span class="material-symbols-rounded {{ $isFavourite ? 'text-red-500' : '' }} mr-2 font-bold">
                            favorite
                        </span>
                        Favourite | {{ $countFavourite }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- modal video --}}
    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-auto max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <iframe class="w-[50rem] h-[24rem]" src="{{ $film->video }}" frameborder="0"
                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
                function showSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'flex'
        }
    
        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'none'
        }
    </script>
</body>

</html>
