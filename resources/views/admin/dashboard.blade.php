@extends('components.main')

@section('title', 'Dashboard')

@section('content')
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <!-- Stat Cards -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-gray-500 text-sm">Total Users</h3>
                <p class="text-2xl font-bold">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-gray-500 text-sm">Total Films</h3>
                <p class="text-2xl font-bold">{{ $totalFilms }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-gray-500 text-sm">Total Favourites</h3>
                <p class="text-2xl font-bold">{{ $totalFavourites }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-gray-500 text-sm">Total Forms</h3>
                <p class="text-2xl font-bold">{{ $totalForms }}</p>
            </div>
        </div>

        <!-- Content Area -->
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-2xl font-bold mb-4">Top 5 Film Terfavorit</h2>
                <canvas id="topFilmsChart"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-2xl font-bold mb-4">Favorit 7 hari Terakhir</h2>
                <canvas id="favouritesLast7DaysChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data untuk chart film yang paling banyak difavoritkan
            const topFilmsLabels = @json($topFilms->pluck('title'));
            const topFilmsData = @json($topFilms->pluck('favourites_count'));

            const topFilmsCtx = document.getElementById('topFilmsChart').getContext('2d');
            new Chart(topFilmsCtx, {
                type: 'pie',
                data: {
                    labels: topFilmsLabels,
                    datasets: [{
                        label: 'Number of Favourites',
                        data: topFilmsData,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
            // Data untuk chart jumlah favorit dalam 7 hari terakhir
            const favouritesLast7DaysLabels = @json($favouritesLast7Days->pluck('date'));
            const favouritesLast7DaysData = @json($favouritesLast7Days->pluck('count'));

            const favouritesLast7DaysCtx = document.getElementById('favouritesLast7DaysChart').getContext('2d');
            new Chart(favouritesLast7DaysCtx, {
                type: 'line',
                data: {
                    labels: favouritesLast7DaysLabels,
                    datasets: [{
                        label: 'Jumlah Favourites',
                        data: favouritesLast7DaysData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
