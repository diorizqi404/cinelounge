<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineLounge | Admin Dashboard</title>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">
    <title>@yield('title', 'Dashboard CineLounge')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #sidebar {
            transition: all 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #main-content {
                margin-left: 0;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    @yield('head')
</head>

<body class="bg-gray-100">
    @include('components.nav-admin')
    @include('components.sidebar-admin')

    <!-- Main Content -->
    <div id="main-content" class="ml-64 pt-16 px-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarToggle = document.getElementById('sidebarToggle');
            let sidebarOpen = window.innerWidth >= 768;

            if (!sidebarOpen) {
                sidebar.style.transform = 'translateX(-100%)';
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-0');
            }

            sidebarToggle.addEventListener('click', () => {
                sidebarOpen = !sidebarOpen;
                if (!sidebarOpen) {
                    sidebar.style.transform = 'translateX(-100%)';
                    mainContent.classList.remove('ml-64');
                    mainContent.classList.add('ml-0');
                } else {
                    sidebar.style.transform = 'translateX(0)';
                    mainContent.classList.remove('ml-0');
                    mainContent.classList.add('ml-64');
                }
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebar.style.transform = 'translateX(0)';
                    mainContent.classList.remove('ml-0');
                    mainContent.classList.add('ml-64');
                    sidebarOpen = true;
                } else {
                    sidebar.style.transform = 'translateX(-100%)';
                    mainContent.classList.remove('ml-64');
                    mainContent.classList.add('ml-0');
                    sidebarOpen = false;
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
</body>

</html>
