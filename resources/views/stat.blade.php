<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<x-app-layout class="bg-gradient-to-r from-cyan-500 to-blue-500">
    {{-- <div class="py-12 bg-gradient-to-r from-cyan-300 to-blue-500 h-full">
        <div class="text-center mx-8" id="calendar">
        </div>
    </div> --}}
    <div class="py-12 bg-gradient-to-r from-cyan-300 to-blue-500 h-screen">
        <div class="container w-3/4 h-3/4 float-center text-center">
            <canvas id="myChart"></canvas>
            <div class="font-bold font-cambria text-xl text-gray-900 mt-8">You made <span class="text-red-800 ">#{{ $totalIncome }}</span> and spent a total of <span class="text-red-800 ">#{{ $totalExpenses }}</span> which accounts for <span class="text-red-800 ">{{ $percentage }}%</span> of your total income. You are left with <span class="text-red-800 ">{{ 100 - $percentage }}%</span></div>
        </div>
    </div>

    <script>
        // Access the percentage value passed from the controller
        var percentage = {{ $percentage }};

        // Use Chart.js to create a Pie Chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Savings', 'Expenditure'],
                datasets: [{
                    data: [percentage, 100 - percentage],
                    backgroundColor: ['#0000FF', '#FF0000'],
                }],
            },
        });
    </script>
</x-app-layout>