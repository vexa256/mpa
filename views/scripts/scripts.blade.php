<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>




<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const responsesContainer = document.getElementById("responses");
        if (responsesContainer) {
            // Delegated event to handle dynamically added buttons
            responsesContainer.addEventListener('click', function(event) {
                if (event.target.className.includes('btn-remove')) {
                    event.target.closest('.input-group').remove();
                }
            });
        }

        const addButton = document.getElementById('addResponseButton');
        if (addButton) {
            addButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission

                // Create the div element to group textarea and button
                var div = document.createElement("div");
                div.className = 'input-group mb-3';

                // Create the textarea element
                var textarea = document.createElement("textarea");
                textarea.className = 'form-control';
                textarea.name =
                    'ReportingToolResponses[]'; // Ensure the name is set correctly for array submission

                // Create the remove button
                var button = document.createElement("button");
                button.className = 'btn btn-secondary btn-remove';
                button.type = 'button';
                button.textContent = 'Remove';

                // Append the textarea and button to the div
                div.appendChild(textarea);
                div.appendChild(button);

                // Append the div to the container
                responsesContainer.appendChild(div);
            });
        }
    });
</script>





@isset($editor)
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>


    <script src="{{ asset('assets/ckeditor/adapters/jquery.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"
        charset="utf-8"></script> --}}

    <script>
        $(document).ready(function() {
            $('textarea').ckeditor(function(textarea) {
                // Callback function code.
            });
        });
    </script>
@endisset



@isset($ChartResults)
    @include('scripts.chartnew')
    <script>
        window.addEventListener("load", (event) => {


            // Assuming you passed $ChartResults to the view as 'results'
            const results = @json($ChartResults);

            // Extracting Description and TotalSpent values
            const labels = results.map(item => item.CostInput);
            const data = results.map(item => item.TotalSpent);

            // Creating the chart
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Spent (from Q1 to Q9)',
                        data: data,
                        backgroundColor: 'purple',
                        borderColor: 'green',
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>


    <script>
        window.addEventListener("load", (event) => {
            // Assuming you passed $ChartResults to the view as 'results'
            const results = @json($ChartResults);

            // Extracting Description and TotalSpent values
            const labels = results.map(item => item.CostInput);
            const data = results.map(item => item.TotalSpent);

            // Creating the chart
            const ctx = document.getElementById('myChart2').getContext(
                '2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Spent (Q1 TO Q9)',
                        data: data,
                        backgroundColor: 'darkblue',
                        borderColor: 'blue',
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    {{-- @include('scripts.chartjs') --}}
@endisset

@isset($ModuleChart)
    @include('scripts.chartnew')
    <script>
        window.addEventListener("load", (event) => {
            const moduleData = @json($ModuleChart);

            // Extracting module names and Q1-20 Feb 2024 Absorption Capacity
            const moduleNames = moduleData.map(item => item.ModuleName);
            const absorptionCapacities = moduleData.map(item => parseFloat(item.Q1To20Feb2024AbsorptionCapacity));

            // Setting up the chart
            const ctx = document.getElementById('moduleAnalyticsChart').getContext('2d');
            const moduleAnalyticsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: moduleNames,
                    datasets: [{
                        label: 'Q1-20 Feb 2024 Absorption Capacity (%)',
                        data: absorptionCapacities,
                        // Assigning each bar a vibrant Material Design color
                        backgroundColor: [
                            'rgba(244, 67, 54, 0.8)', // Red 500
                            'rgba(233, 30, 99, 0.8)', // Pink 500
                            'rgba(156, 39, 176, 0.8)', // Purple 500
                            'rgba(103, 58, 183, 0.8)', // Deep Purple 500
                            'rgba(63, 81, 181, 0.8)', // Indigo 500
                            'rgba(33, 150, 243, 0.8)', // Blue 500
                            'rgba(3, 169, 244, 0.8)', // Light Blue 500
                            'rgba(0, 188, 212, 0.8)', // Cyan 500
                            'rgba(0, 150, 136, 0.8)', // Teal 500
                            'rgba(76, 175, 80, 0.8)', // Green 500
                            'rgba(139, 195, 74, 0.8)', // Light Green 500
                            'rgba(205, 220, 57, 0.8)', // Lime 500
                            'rgba(255, 235, 59, 0.8)', // Yellow 500
                            'rgba(255, 193, 7, 0.8)' // Amber 500
                            // Add more colors as needed
                        ],
                        borderColor: 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        barThickness: 20,
                        categoryPercentage: 0.4,
                        barPercentage: 0.4
                    }]
                },
                options: {
                    indexAxis: 'y', // Keeps the chart horizontal
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Absorption Capacity (%)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Module Absorption Capacity Q1-20 Feb 2024'
                        }
                    }
                }
            });
        });
    </script>
@endisset


@isset($ModuleExpenditures)
    @include('scripts.chartnew')
    <script>
        window.addEventListener("load", (event) => {
            // Assuming you passed $ModuleExpenditures to the view as 'moduleData'
            const moduleData = @json($ModuleExpenditures);

            // Extract values
            const moduleNames = moduleData.map(item => item.Modules);
            const totalBudget = moduleData.map(item => item
                .Total_Budget_Q1_to_Q9);
            const totalExpenditure = moduleData.map(item => item
                .Total_Expenditure_Q1_to_Q9);
            const totalBudgetBalance = moduleData.map(item => item
                .Total_Budget_Balance_Q1_to_Q9);

            // Create the horizontal bar chart
            const ctx = document.getElementById('moduleExpenditureChart')
                .getContext('2d');
            const moduleExpenditureChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: moduleNames,
                    datasets: [{
                            label: 'Total Budget Budget Q1-Q11 in USD',
                            data: totalBudget,
                            backgroundColor: 'darkblue',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            barThickness: 20,
                            categoryPercentage: 0.4,
                            barPercentage: 0.4
                        },
                        {
                            label: 'Total Expenditure up to 20-FEB 2024 in USD',
                            data: totalExpenditure,
                            backgroundColor: 'blue',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            barThickness: 20,
                            categoryPercentage: 0.4,
                            barPercentage: 0.4
                        },
                        {
                            label: 'Q1 to 20-FEB 2024 Budget Balance in USD',
                            data: totalBudgetBalance,
                            backgroundColor: 'purple',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1,
                            barThickness: 20,
                            categoryPercentage: 0.4,
                            barPercentage: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y', // This will make the chart horizontal
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endisset



@include('not.not')
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

@if (isset($rem))
    <script>
        $(function() {
            setInterval(function() {
                @foreach ($rem as $val)
                    // console.log(".x_{{ $val }}");
                    $(".x_{{ $val }}").remove();
                @endforeach
            }, 1000);



        });
    </script>
@endif


@isset($ProjectSummary)
    @include('scripts.chartnew')

    <script>
        window.addEventListener("load", (event) => {
            const summaryData = @json($ProjectSummary);

            // Extracting values for the chart from the summaryData, assuming it's in the correct structure
            const totalGrant = summaryData.map(item => item.TotalGrant);
            const fundDisbursement = summaryData.map(item => item.FundDisbursement_Q1_Feb_20_2024);
            const interestFromBank = summaryData.map(item => item.InterestFromBank_ExchangeRateGain_Q1_Feb_20_2024);
            const totalBudget = summaryData.map(item => item.TotalBudget_Q1_Feb_20_2024);
            const totalFund = summaryData.map(item => item.TotalFund_Q1_Feb_20_2024);
            const expenditure = summaryData.map(item => item.Expenditure_Q1_Feb_20_2024);
            const balanceOfFunds = summaryData.map(item => item.BalanceOfFunds);

            // Assuming only one item in the dataset for simplicity
            const undisbursed = totalGrant[0] - fundDisbursement[0];

            // Creating the chart
            const ctx = document.getElementById('summaryExactChart').getContext('2d');
            const summaryExactChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Grant', 'Disbursed', 'Undisbursed', 'Interest', 'Budget', 'Total Fund',
                        'Expenditure', 'Balance'
                    ],
                    datasets: [{
                        label: 'Financial Summary (USD)',
                        data: [
                            totalGrant[0],
                            fundDisbursement[0],
                            undisbursed,
                            interestFromBank[0],
                            totalBudget[0],
                            totalFund[0],
                            expenditure[0],
                            balanceOfFunds[0]
                        ],
                        backgroundColor: [
                            'rgba(0, 0, 139, 1)',
                            'rgba(0, 128, 0, 1)',
                            'rgba(255, 140, 0, 1)',
                            'rgba(255, 0, 0, 1)',
                            'rgba(0, 0, 255, 1)',
                            'rgba(128, 0, 128, 1)',
                            'rgba(255, 192, 203, 1)',
                            'rgba(128, 128, 128, 1)'
                        ],
                        borderColor: [
                            'darkblue',
                            'green',
                            'orange',
                            'red',
                            'blue',
                            'purple',
                            'pink',
                            'gray'
                        ],
                        borderWidth: 1,
                        barThickness: 20,
                        categoryPercentage: 0.5,
                        barPercentage: 0.5,
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endisset

</body>


</html>
