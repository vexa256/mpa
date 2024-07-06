<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>




<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        function waitForElement(selector, timeout) {
            let intervalId;
            let hasTimedOut = false;

            const promise = new Promise((resolve, reject) => {
                intervalId = setInterval(() => {
                    const element = document.querySelector(selector);
                    if (element) {
                        clearInterval(intervalId);
                        resolve(element);
                    }
                }, 300); // check every 300ms

                setTimeout(() => {
                    if (!document.querySelector(selector)) {
                        hasTimedOut = true;
                        clearInterval(intervalId);
                        reject(new Error("Element not found within time limit"));
                    }
                }, timeout);
            });

            promise.then(element => {
                // Initialize Stepper
                const stepper = new KTStepper(element);

                // Handle next step
                stepper.on("kt.stepper.next", function(stepper) {
                    stepper.goNext(); // go next step
                });

                // Handle previous step
                stepper.on("kt.stepper.previous", function(stepper) {
                    stepper.goPrevious(); // go previous step
                });
            }).catch(error => {
                console.error(error.message);
            });
        }

        waitForElement("#kt_stepper_example_basic", 5000); // wait for up to 5000ms (5 seconds)

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



{{-- @isset($tinMCE) --}}
<script src="https://cdn.tiny.cloud/1/1nr3t3t5xeyg86kk7vb6p7u0d9eo1w4zd7dy14p1volsp9ed/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    });
</script>
{{-- @endisset --}}

{{-- @isset($editor)
    <script src="{{ asset('assets/ckeditor/build/ckeditor.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const watchdog = new CKSource.EditorWatchdog();
            window.watchdog = watchdog;

            watchdog.setCreator((element, config) => {
                return CKSource.Editor.create(element, config).then(editor => editor);
            });

            watchdog.setDestructor(editor => {
                return editor.destroy();
            });

            watchdog.on('error', (error) => {
                console.error('Error initializing CKEditor:', error);
            });

            // Function to initialize editors
            const initializeEditors = () => {
                const textareas = document.querySelectorAll('textarea.EditorMe');
                textareas.forEach(textarea => {
                    if (!textarea.hasAttribute('data-editor-initialized')) {
                        watchdog.create(textarea, {
                            // Add your CKEditor configuration here
                        }).catch((error) => {
                            console.error('CKEditor creation error:', error);
                        });
                        textarea.setAttribute('data-editor-initialized', 'true');
                    }
                });
            };

            // Function to destroy all editors
            const destroyEditors = () => {
                const editors = watchdog.editors;
                if (editors) {
                    editors.forEach(editor => {
                        editor.destroy()
                            .catch(error => console.error('Error destroying the editor:', error));
                    });
                }
            };

            // Wait for an element to be ready before initializing editors
            const waitForElement = (selector, maxAttempts = 5, interval = 1000, attempt = 0) => {
                setTimeout(() => {
                    if (document.querySelector(selector)) {
                        initializeEditors();
                    } else if (attempt < maxAttempts) {
                        waitForElement(selector, maxAttempts, interval, attempt + 1);
                    } else {
                        console.error('Element not found within time limit:', selector);
                    }
                }, interval);
            };

            // Listen for any modal shown event
            $(document).on('shown.bs.modal', function() {
                destroyEditors(); // Destroy instances before re-initializing them
                waitForElement(
                    'textarea.EditorMe'); // Check if the textarea is available before initializing
            });

            // Optional: Destroy editors when modal is hidden
            $(document).on('hidden.bs.modal', function() {
                destroyEditors();
            });
        });
    </script>
@endisset --}}





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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('WarnBeforeSubmit').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting

            Swal.fire({
                title: 'Are you sure?',
                text: "Once this action is executed, the current indicator scores and reported data will be deleted. This action is not reversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit(); // Submit the form if the user confirms
                }
            });
        });
    });
</script>
</body>


</html>
