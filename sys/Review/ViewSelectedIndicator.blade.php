<div class="container mt-4">

    <div class="row g-4">
        <div class="col-4">


            <form method="POST" enctype="multipart/form-data" action="{{ route('ApproveIndicator') }}">
                @csrf

                <input type="hidden" name="IID" value="{{ $IID }}">

                <input type="hidden" name="RID" value="{{ $RID }}">

                <input type="hidden" name="Entity" value="{{ $Entity }}">



                <button type="submit" class="btn mx-1 float-end   mb-2 m btn-primary">
                    <i class="fas me-1 fa-check " aria-hidden="true"></i>Approve</button>
            </form>

        </div>

        <div class="col-4">
            <button type="button" class="btn mx-1 float-end   mb-2 btn-danger" data-bs-toggle="modal"
                data-bs-target="#New">
                <i class="fas me-1 fa-times " aria-hidden="true"></i>Return Indicator</button>

        </div>


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


@include('Review.ReturnIndicator')
