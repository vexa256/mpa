<div class="card card-flush h-md-100">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0"
        style="background-position: 50% 50%; background-image: url('https://www.svgrepo.com/show/273732/gears-setup.svg'); background-size: 30%;">
        <!--begin::Wrapper-->
        <div class="mb-10">
            <!--begin::Title-->
            <div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
                <span class="me-2">
                    Oops, Reporting entities have missing indicators,
                    <br>
                    <span class="position-relative d-inline-block text-danger">
                        <a href="{{ route('SelectIndicatorCategory') }}" class="text-danger opacity-75-hover">Please
                            complete the indicator database to
                            proceed</a>

                        <!--begin::Separator-->
                        <span
                            class="position-absolute opacity-15 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                        <!--end::Separator-->
                    </span>
                </span>
                for Free
            </div>
            <!--end::Title-->

            <!--begin::Action-->
            <div class="text-center">
                <a href="{{ route('SelectIndicatorCategory') }}" class="btn btn-sm btn-dark fw-bold">
                    Complete Indicator Setup
                </a>
            </div>
            <!--begin::Action-->
        </div>
        <!--begin::Wrapper-->

        <!--begin::Illustration-->
        <img class="mx-auto h-150px h-lg-200px  theme-light-show"
            src="/metronic8/demo1/assets/media/illustrations/misc/upgrade.svg" alt="">
        <img class="mx-auto h-150px h-lg-200px  theme-dark-show"
            src="/metronic8/demo1/assets/media/illustrations/misc/upgrade-dark.svg" alt="">
        <!--end::Illustration-->
    </div>
    <!--end::Body-->
</div>
