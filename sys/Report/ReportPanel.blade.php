<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-4 mb-xl-10">

        <!--begin::Card widget 2-->
        <div class="card bg-dark text-light fw-bolder h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex 
            justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="fas fa-compass fs-2hx text-light fw-bolder"></i>

                </div>
                <!--end::Icon-->

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class=" fs-3x text-light fw-bolder lh-1 ls-n2">

                        {{ $RRF }}
                    </span>
                    <!--end::Number-->

                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-light fw-bolder">
                            Regional Results Framework
                        </span>

                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->

                <!--begin::Badge-->
                <span class="badge badge-light-success fs-base">
                    <i class="fas fa-arrow-up fs-5 text-success ms-n1"></i>

                    {{ $report->ReportType }} Reported Indicators
                </span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->


    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-sm-6 col-xl-4 mb-xl-10">

        <!--begin::Card widget 2-->
        <div class="card bg-warning h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="fas fa-chart-line fs-2hx fw-bolder text-dark"></i>

                </div>
                <!--end::Icon-->

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fw-bolder
                     text-dark fs-3x  lh-1 ls-n2">
                        {{ $CRF }}</span>
                    <!--end::Number-->

                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 fw-bolder text-dark">
                            Country Specific Results Framework </span>

                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->

                <!--begin::Badge-->
                <span class="badge badge-light-success fs-base">
                    <i class="fas  fa-arrow-up fs-5 text-success ms-n1"></i>

                    {{ $report->ReportType }} Reported Indicators </span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->


    </div>
    <!--end::Col-->

    <div class="col-sm-6 col-xl-4 mb-xl-10">

        <!--begin::Card widget 2-->
        <div class="card bg-primary text-light fw-bolder h-lg-100">
            <!--begin::Body-->
            <div class="card-body text-light fw-bolder d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="fas text-light fw-bolder  fa-chart-pie fs-2hx"></i>

                </div>
                <!--end::Icon-->

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold text-light fw-bolder fs-3x lh-1 ls-n2">

                        {{ $CRF + $RRF }}

                    </span>
                    <!--end::Number-->

                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold text-light fw-bolder fs-6 ">

                            Total Indicators
                        </span>

                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->

                <!--begin::Badge-->
                <span class="badge badge-light-success fs-base">
                    <i class="fas fa-arrow-up fs-5 text-success ms-n1"></i>

                    {{ $report->ReportType }} Reported Indicators
                </span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->


    </div>

    <!--end::Col-->
</div>
