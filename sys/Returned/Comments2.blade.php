@isset($CRPITM)
    @foreach ($CRPITM as $data)
        <div class="modal fade" id="CRPITM{{ $data->indicatorReportID }}" tabindex="-1" style="display: none;"
            aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog modal-fullscreen">
                <!--begin::Modal content-->
                <div class="modal-content rounded">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1">
                                </span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->

                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Reasons why this indicator was returned</h1>
                            <!--end::Title-->

                            <!--begin::Description-->
                            <div class=" fw-bold text-danger fs-5">
                                {{ $data->Indicator }}
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--begin:Form-->
                        <form action="{{ route('ReturnIndicator') }}" class="
                row" method="POST"
                            enctype=multipart/form-data>
                            @csrf

                            <div class="mb-3 col-md-12">
                                <label for="ResponseType" class="px-5 required form-label">
                                    Reason for returning the indicator
                                </label>
                                <textarea name="ReasonForReturningTheIndicator">
                            <h1>Your Response</h1>
                            {{ $data->Response }}

                            <h1>Your Comments</h1>
                            {{ $data->Comments }}

                            <h1>Reasons for returning the indicator</h1>



                        </textarea>
                            </div>

                            {{-- <input type="hidden" name="TableName" value="indicator_reports"> --}}

                            {{-- <input type="hidden" name="IID" value="{{ $IID }}">

                            <input type="hidden" name="RID" value="{{ $RID }}">

                            <input type="hidden" name="Entity" value="{{ $Entity }}"> --}}



                            <!--end:Form-->
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-dark">Return Indicator</button>

                        </form>
                    </div>
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
    @endforeach

@endisset
