<div class="container mt-4">

    <div class="row g-4">

        <div class="col-12">
            <!-- Card for each report -->
            <div class="card h-100 shadow-sm" style="border: 2px solid #dee2e6;">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title text-white">Indicator Reported Response</h4>
                </div>
                <div class="card-body bg-light">
                    <textarea name="Response" class="form-control EditorMe" aria-label="With textarea">
                        <h4>Indicator : {{ $IndicatorData->Indicator }}</h4>
                        {{ $IndicatorData->Response }}

                    </textarea>

                </div>
            </div>
        </div>
        <div class="col-6">
            <!-- Card for each report -->
            <div class="card h-100 shadow-sm" style="border: 2px solid #dee2e6;">
                <div class="card-header bg-danger text-white">
                    <h4 class="card-title text-white">Indicator Reported Comments</h4>
                </div>
                <div class="card-body bg-light">
                    <textarea name="Response" class="form-control EditorMe" aria-label="With textarea">

                        {{ $IndicatorData->Comments }}

                    </textarea>

                </div>
            </div>
        </div>
        <div class="col-6">
            <!-- Card for each report -->
            <div class="card h-100 shadow-sm" style="border: 2px solid #dee2e6;">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title text-white">Indicator Reported Score</h4>
                </div>
                <div class="card-body bg-light">
                    <textarea name="Response" class="form-control EditorMe" aria-label="With textarea">

                        {{ $IndicatorData->IndicatorResponsePercentageScore }}

                    </textarea>

                </div>
            </div>
        </div>
    </div>
</div>
