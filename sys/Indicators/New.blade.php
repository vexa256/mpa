<div class="modal fade" id="New" tabindex="-1" style="display: none;" aria-hidden="true">
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
                    <h1 class="mb-3">Create a new indicator</h1>
                    <!--end::Title-->

                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-5">
                        Please fill in the whole form.
                    </div>
                    <!--end::Description-->
                </div>
                <!--begin:Form-->
                <form action="{{ route('CreateIndicator') }}" class="
                row" method="POST"
                    enctype=multipart/form-data>
                    @csrf





                    <div class="mb-3 col-md-4">
                        <label for="ResponseType" class="px-5 required form-label">
                            Indicator Response Category
                        </label>
                        <select required name="ResponseType" class="form-select form-select-solid"
                            data-control="select2" data-placeholder="Select a option">
                            <option></option>
                            <option value="Yes/No">Yes/No</option>
                            <option value="Percentage">Percentage</option>
                            <option value="Number">Number</option>
                            <option value="Text">Text (Narrative)</option>
                            <option value="Date">Date</option>
                        </select>
                    </div>


                    <div class="mb-3 col-md-4">
                        <label for="ResponseType" class="px-5 required form-label">
                            Reporting Period
                        </label>
                        <select required name="ReportingPeriod" class="form-select form-select-solid"
                            data-control="select2" data-placeholder="Select a option">
                            <option></option>
                            <option value="Annually">Annually</option>
                            <option value="Quarterly">Quarterly</option>

                        </select>
                    </div>


                    <div class="mb-3 col-md-4 ">
                        <label id="label" for="" class="px-5 required form-label">
                            Indicator Type</label>
                        <select required name="IndicatorSecondaryCategory" class="form-select  form-select-solid"
                            data-control="select2" data-placeholder="Select a option">
                            <option></option>

                            <option value="Regional Intermediate Results Indicators">Regional Intermediate Results
                                Indicators
                            </option>

                            <option value="Country Specific Intermediate Results Indicators">Country Specific
                                Intermediate
                                Results
                                Indicators
                            </option>

                            <option value="Regional Project Development Objective Indicators">
                                Regional Project Development Objective Indicators </option>

                            <option value="Country Specific Project Development Objective Indicators">
                                Country Specific Project Development Objective Indicators </option>


                        </select>

                    </div>


                    {{-- <div class="mb-3 col-md-6 ">
                        <label id="label" for="" class="px-5 required form-label">
                            Reporting Entity </label>
                        <select required name="Entity" class="form-select  form-select-solid" data-control="select2"
                            data-placeholder="Select a option">
                            <option></option>

                            <option value="STP"> STP
                            </option>

                            <option value="Ethiopia"> Ethiopia
                            </option>

                            <option value="Kenya"> Kenya
                            </option>

                            <option value="ECSA-HC"> ECSA-HC
                            </option>

                            <option value="IGAD"> IGAD
                            </option>



                        </select>

                    </div> --}}

                    <div class="mb-3 col-6 my-3">
                        <label for="Indicator" class="form-label">Project
                            Indicator:</label>
                        <textarea type="text" class="form-control" id="Indicator" name="Indicator" required></textarea>
                    </div>




                    <div class="mb-3 col-6 my-3">
                        <label class="form-label">Reporting Tool Responses:</label>
                        <div id="responses">
                            <div class="input-group mb-3">
                                <textarea type="text" class="form-control" name="ReportingToolResponses[]"></textarea>
                                <button id="addResponseButton" class="btn btn-primary">Add Response</button>

                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-6 my-3">
                        <label for="SourceOfData" class="form-label">Source of Data:</label>
                        <textarea type="text" class="form-control" id="SourceOfData" name="SourceOfData" required></textarea>
                    </div>
                    <div class="mb-3 col-6 my-3">
                        <label for="ReportingRequirements" class="form-label">Reporting Requirements:</label>
                        <textarea type="text" class="form-control" id="ReportingRequirements" name="ReportingRequirements" required></textarea>
                    </div>


                    <input type="hidden" name="IID"
                        value="{{ md5(uniqid() . 'AFC' . date('Y-m-d H:I:S')) }}"></input>

                    <input type="hidden" name="TableName" value="project_indicators">



                    <input type="hidden" name="created_at" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="IndicatorPrimaryCategory" value="{{ $IndicatorPrimaryCategory }}">
                    <input type="hidden" name="Entity" value="{{ $Entity }}">
                    <input type="hidden" name="RemarksComments" value="RemarksComments">
                    {{-- <input type="hidden" name="IndicatorSecondaryCategory" value="IndicatorSecondaryCategory"> --}}


                    <!--end:Form-->
            </div>
            <!--end::Modal body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-dark">Save
                    Changes</button>

                </form>
            </div>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
