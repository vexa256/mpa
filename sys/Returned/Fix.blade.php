<div class="container">
    <div class="card">
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-pills" id="kt_stepper_example_basic">
                <!--begin::Nav-->
                <div class="stepper-nav flex-center flex-wrap mb-10">
                    <!--begin::Step 1-->
                    <div class="stepper-item mx-8 my-4 current" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">1</span>
                            </div>
                            <!--end::Icon-->

                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Step 1
                                </h3>

                                <div class="stepper-desc">
                                    Indicator Details
                                </div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 2-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">2</span>
                            </div>
                            <!--begin::Icon-->

                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Step 2
                                </h3>

                                <div class="stepper-desc">
                                    Report on indicator
                                </div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 2-->

                    <!--begin::Step 3-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">3</span>
                            </div>
                            <!--begin::Icon-->

                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Step 3
                                </h3>

                                <div class="stepper-desc">
                                    Confirm Submission
                                </div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 3-->


                </div>
                <!--end::Nav-->

                <!--begin::Form-->
                <form action="{{ route('MassInsert') }}" method="POST" class="form  mx-auto" novalidate="novalidate"
                    id="kt_stepper_example_basic_form">

                    @csrf
                    <!--begin::Group-->
                    <div class="mb-5">
                        <!--begin::Step 1-->
                        <div class="flex-column current" data-kt-stepper-element="content">
                            <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                                <thead>
                                    <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                                        <th class="bg-dark text-light fw-bolder">Category</th>
                                        <th class="bg-dark text-light fw-bolder">Type</th>
                                        <th class="bg-warning text-dark fw-bolder">Entity</th>
                                        <th class="bg-warning text-dark fw-bolder">Indicator</th>
                                        <th class="bg-primary text-light fw-bolder">Reporting Tool </th>
                                        <th class="bg-dark text-light fw-bolder">Source Of Data</th>
                                        <th class="bg-dark text-light fw-bolder">Reporting Requirements</th>




                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="bg-dark text-light fw-bolder">
                                            {{ $IndicatorData->IndicatorPrimaryCategory }}</td>
                                        <td class="bg-dark text-light fw-bolder">
                                            {{ $IndicatorData->IndicatorSecondaryCategory }}</td>
                                        <td class="bg-dark text-light fw-bolder">{{ $IndicatorData->Entity }}</td>
                                        <td class="bg-warning text-dark fw-bolder">{{ $IndicatorData->Indicator }}</td>
                                        <td class="bg-warning text-dark fw-bolder">


                                            @foreach (json_decode($IndicatorData->ReportingToolResponses) as $response)
                                                <li>{{ $response }}</li>
                                            @endforeach


                                        </td>
                                        <td class="bg-danger text-light fw-bolder">{{ $IndicatorData->SourceOfData }}
                                        </td>
                                        <td class="bg-primary text-light fw-bolder">
                                            {{ $IndicatorData->ReportingRequirements }}</td>
                                        {{-- <td>{{ $IndicatorData->SourceOfData }}</td> --}}

                                    </tr>



                                </tbody>
                            </table>
                        </div>
                        <!--begin::Step 1-->

                        <!--begin::Step 1-->
                        <div class="flex-column" data-kt-stepper-element="content">


                            <input name="ReportedBy" type="hidden" value="{{ Auth::user()->email }}">
                            <input name="Entity" type="hidden" value="{{ $IndicatorData->Entity }}">
                            <input name="RID" type="hidden" value="{{ $RID }}">
                            <input name="IID" type="hidden" value="{{ $IndicatorData->IID }}">
                            <input name="TableName" type="hidden" value="indicator_reports">


                            <div class="mb-5">
                                <!--begin::Input group-->
                                <div class="input-group">
                                    <span class="input-group-text">Responses </span>
                                    <textarea name="Response" class="form-control EditorMe" aria-label="With textarea">

                                        <table border="1">
                                            <thead>
                                                <tr >
                                                    
                                                  
                                                    <th style="background-color:
                                                     cyan;">Indicator</th>
                                                    <th style="background-color:
                                                    rgb(231, 171, 213);">Reporting Tool Question</th>
                                                    <th  style="background-color:
                                                    rgb(166, 154, 233);">Reporting Tool Response</th>
                                                   
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
<tr>
                                                       
                                                        <td style="font-weight: bold;">{{ $IndicatorData->Indicator }}</td>
                                                       
                                                        <td style="font-weight: bold;">
                                                            @php
                                                                $responses = json_decode(
                                                                    $IndicatorData->ReportingToolResponses,
                                                                    true,
                                                                );

                                                                function clean_response($response)
                                                                {
                                                                    // Replace patterns like "1.\u00a0\u00a0\u00a0\u00a0" with an empty string
                                                                    return preg_replace('/^\d+\.\s+/', '', $response);
                                                                }
                                                            @endphp
                                                        
                                                            @if ($responses)
<ul>
                                                                    @foreach ($responses as $index => $response)
<li><span style="font-weight: bolder">Question {{ $index + 1 }}</span>. {{ clean_response($response) }}</li> <br><br>
@endforeach
                                                                </ul>
@else
{{ json_encode($indicator->ReportingToolResponses) }}
@endif
                                                        </td>
                                                        
                                                        <td style="font-weight: bold;">
                                                            @php
                                                                $responses = json_decode(
                                                                    $IndicatorData->ReportingToolResponses,
                                                                    true,
                                                                );
                                                            @endphp
                                                            @if ($responses)
<ul>
                                                                    @foreach ($responses as $index => $response)
<li>
                                                                            
                                                                            <h5>Type your response here</h5>
                                                                            
                                                                        </li>
@endforeach
                                                                </ul>
@else
{{ json_encode($IndicatorData->ReportingToolResponses) }}
@endif
                                                        </td>
                                                        
                                                       
                                                    </tr>

                                            </tbody>
                                        </table>
                                    </textarea>
                                </div>

                            </div>

                            <div class="mb-5">
                                <!--begin::Input group-->
                                <div class="input-group">
                                    <span class="input-group-text">Remarks/Comments </span>
                                    <textarea name="Comments" class="EditorMe form-control" aria-label="With textarea"></textarea>
                                </div>

                            </div>
                            <!--end::Input group-->
                            {{-- here --}}

                            <div class="col-12">
                                @php
                                    $responseType = $IndicatorData->ResponseType;
                                @endphp

                                <div class="col-md-12 mb-3 mt-3">
                                    <div class="mb-3">
                                        <label class="required form-label" for="responseField">
                                            {{ $IndicatorData->Indicator }}
                                        </label>

                                        @if ($responseType == 'Yes/No')
                                            <select required name="IndicatorResponsePercentageScore"
                                                id="responseField" class="form-select form-select-solid"
                                                data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        @elseif ($responseType == 'Percentage')
                                            <input type="number" required name="IndicatorResponsePercentageScore"
                                                id="responseField" class="form-control form-control-solid"
                                                min="0" max="100" step="1"
                                                placeholder="Enter percentage">
                                        @elseif ($responseType == 'Number')
                                            <input type="number" required name="IndicatorResponsePercentageScore"
                                                id="responseField" class="form-control form-control-solid IntOnlyNow"
                                                step="any" placeholder="Enter a number">
                                        @elseif ($responseType == 'Text')
                                            <textarea required name="IndicatorResponsePercentageScore" id="responseField" class="form-control form-control-solid"
                                                rows="4" placeholder="Enter text"></textarea>
                                        @elseif ($responseType == 'Date')
                                            <input type="date" required name="IndicatorResponsePercentageScore"
                                                id="responseField" class="form-control form-control-solid DateArea"
                                                placeholder="Select a date">
                                        @else
                                            <input type="text" required name="IndicatorResponsePercentageScore"
                                                id="responseField" class="form-control form-control-solid"
                                                placeholder="Enter response">
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!--begin::Step 1-->

                        <!--begin::Step 1-->
                        <div class="flex-column" data-kt-stepper-element="content">

                            <div class="card h-md-100" dir="ltr">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column flex-center">
                                    <!--begin::Heading-->
                                    <div class="mb-2">
                                        <!--begin::Title-->
                                        <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                                            Hey {{ Auth::user()->name }} <br> Please confirm that all the
                                            <span class="fw-bolder"> entered data is correct</span>
                                        </h1>
                                        <!--end::Title-->

                                        <!--begin::Illustration-->
                                        <div class="py-10 text-center">
                                            <img src="https://www.svgrepo.com/show/475325/confirm.svg"
                                                class="theme-light-show w-200px" alt="">

                                        </div>
                                        <!--end::Illustration-->
                                    </div>
                                    <!--end::Heading-->


                                </div>
                                <!--end::Body-->
                            </div>

                            <!--end::Input group-->
                        </div>
                        <!--begin::Step 1-->


                    </div>
                    <!--end::Group-->

                    <!--begin::Actions-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="me-2">
                            <button type="button" class="btn btn-primary btn-light btn-active-light-primary"
                                data-kt-stepper-action="previous">
                                Back
                            </button>
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" class="btn btn-danger" data-kt-stepper-action="submit">
                                <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>

                            <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                                Continue
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
    </div>
</div>
