<div class="row g-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-12">

        <!--begin::Table widget 13-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Country Specific Results Framework Indicators</span>

                    <span class="text-gray-500 mt-1 fw-bolder fs-6">{{ $report->ReportTitle }} |
                        {{ $report->ReportDescription }}</span>
                </h3>
                <!--end::Title-->

                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                    <div class="btn btn-sm btn-light d-flex align-items-center px-4" data-kt-initialized="1">
                        <!--begin::Display range-->
                        <div class="text-danger-600 fw-bold">{{ $report->ReportType }} Report Filing</div>
                        <!--end::Display range-->

                        <i class="ki-duotone ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0"><span
                                class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                    </div>
                    <!--end::Daterangepicker-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body pt-3 pb-4">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th class="p-0 min-w-200px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-125px"></th>
                                <th class="p-0 min-w-125px"></th>
                                {{-- <th class="p-0 w-100px"></th> --}}
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            @isset($IndicatorData)
                                @foreach ($IndicatorData as $data)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-40px me-3">
                                                    <img src="https://www.svgrepo.com/show/530229/monitor.svg"
                                                        class="" alt="">
                                                </div>

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $data->Indicator }}</a>
                                                    <span
                                                        class="text-danger fw-bolder d-block fs-7">{{ $data->IndicatorSecondaryCategory }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-end">
                                            <span
                                                class="text-gray-800 fw-bold d-block mb-1 fs-6">{{ $data->SourceOfData }}</span>
                                            <span class="fw-semibold text-gray-500 d-block">Source of Reported Data</span>
                                        </td>

                                        <td class="text-end">
                                            <a href="#"
                                                class="text-gray-800 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $data->ReportingRequirements }}</a>
                                            <span class="text-gray-500 fw-semibold d-block fs-7">Reporting
                                                Requirements</span>
                                        </td>

                                        <td class="float-end text-end border-0">
                                            <a href="{{ route('ReportCF', ['Entity' => $Entity, 'RID' => $RID, 'id' => $data->id]) }}"
                                                class="btn btn-danger">

                                                Report
                                            </a>


                                        </td>


                                    </tr>
                                @endforeach

                            @endisset

                            @isset($IndicatorData2)
                                @foreach ($IndicatorData2 as $data)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-40px me-3">
                                                    <img src="https://www.svgrepo.com/show/530443/interface-control.svg"
                                                        class="" alt="">
                                                </div>

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $data->Indicator }}</a>
                                                    <span
                                                        class="text-primary fw-bolder d-block fs-7">{{ $data->IndicatorSecondaryCategory }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-end">
                                            <span
                                                class="text-gray-800 fw-bold d-block mb-1 fs-6">{{ $data->SourceOfData }}</span>
                                            <span class="fw-semibold text-gray-500 d-block">Source of Reported Data</span>
                                        </td>

                                        <td class="text-end">
                                            <a href="#"
                                                class="text-gray-800 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $data->ReportingRequirements }}</a>
                                            <span class="text-gray-500 fw-semibold d-block fs-7">Reporting
                                                Requirements</span>
                                        </td>

                                        <td class="float-end text-end border-0">
                                            <a href="{{ route('ReportCF', ['Entity' => $Entity, 'RID' => $RID, 'id' => $data->id]) }}"
                                                class="btn btn-danger">

                                                Report
                                            </a>


                                        </td>


                                    </tr>
                                @endforeach

                            @endisset

                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <!--end::Table container-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::Table widget 13-->
    </div>
    <!--end::Col-->


</div>
