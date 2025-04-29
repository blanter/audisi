<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-4 pb-4">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg diff-p5">
                <!-- START -->
                <h3 class="small-heading">Data Summary</h3>
                <div class="colored-dashboard">
                    <div class="colored-box">
                        <div class="number-box">10</div>
                        <div class="title-box">Terdaftar</div>
                    </div>
                    <div class="colored-box">
                        <div class="number-box">10</div>
                        <div class="title-box">Selesai Audisi 1</div>
                    </div>
                    <div class="colored-box">
                        <div class="number-box">10</div>
                        <div class="title-box">Selesai Audisi 2</div>
                    </div>
                    <div class="colored-box">
                        <div class="number-box">10</div>
                        <div class="title-box">Production</div>
                    </div>
                </div>

                <h3 class="mt-5 small-heading">Statistics</h3>
                <canvas id="projectChart" class="mt-4 mb-4" width="400" height="200"></canvas>
                <script>
                    const ctx = document.getElementById('projectChart').getContext('2d');
                    const projectChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Alam', 'Sosial', 'English', 'Forum', 'Campuran'],
                            datasets: [
                                {
                                    label: 'Stage',
                                    data: [10, 20, 30, 15, 25],
                                    backgroundColor: 'rgba(123, 104, 238, 0.7)', // light purple
                                    borderRadius: 5
                                },
                                {
                                    label: 'Showcase',
                                    data: [30, 25, 10, 20, 10],
                                    backgroundColor: 'rgba(221, 160, 221, 0.7)', // light violet
                                    borderRadius: 5
                                },
                                {
                                    label: 'Video',
                                    data: [5, 15, 20, 10, 30],
                                    backgroundColor: 'rgba(144, 238, 144, 0.7)', // light green
                                    borderRadius: 5
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                </script>

                <!-- END -->
            </div>
        </div>
    </div>
</x-app-layout>
