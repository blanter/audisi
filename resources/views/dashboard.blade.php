<x-app-layout>
    <script src="{{asset('/js/chart.js')}}"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg></span>
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
                        <div class="title-box">Peserta Audisi</div>
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
