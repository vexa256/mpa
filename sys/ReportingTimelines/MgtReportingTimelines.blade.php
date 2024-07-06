<!--begin::Card body-->
<div class="card-body pt-3  fw-bolder text-white shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = 'Manage reporing timelines',
        $Msg = 'Set reporting time paramaters',
    ) !!}
</div>

{{-- @include('Indicators.IndicatorPanel') --}}

<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Timeline', $Icon = 'fa-plus') }}
    <table class="mytable table table-rounded table-bordered border gy-3 gs-3">
        <thead>
            <tr>
                {{-- <th class="bg-dark fw-bolder text-light">RID</th> --}}
                <th class="bg-dark fw-bolder text-light">Report Title</th>
                <th class="bg-dark fw-bolder text-light">Report Description</th>
                <th class="bg-dark fw-bolder text-light">Report Type</th>
                <th class="bg-dark fw-bolder text-light">Reporting Year</th>
                <th class="bg-dark fw-bolder text-light">Reporting Quarter</th>
                <th class="bg-dark fw-bolder text-light">Reporting Start Date</th>
                <th class="bg-dark fw-bolder text-light">Reporting End Date</th>
                <th class="bg-danger fw-bolder text-light">Actions</th>
            </tr>
        </thead>
        <tbody>
            @isset($DataBaseData)
                @foreach ($DataBaseData as $data)
                    <tr>
                        {{-- <td class="bg-light fw-bolder text-dark">{{ $data->RID }}</td> --}}
                        <td class="bg-light fw-bolder text-dark">{{ $data->ReportTitle }}</td>
                        <td class="bg-light fw-bolder text-dark">{{ $data->ReportDescription }}</td>
                        <td class="bg-light fw-bolder text-dark">{{ $data->ReportType }}</td>
                        <td class="bg-light fw-bolder text-dark">{{ $data->ReportingYear }}</td>
                        <td class="bg-light fw-bolder text-dark">{{ $data->ReportingQuarter }}</td>
                        <td class="bg-light fw-bolder text-dark">{{ $data->ReportingStartDate }}</td>
                        <td class="bg-light fw-bolder text-dark">
                            {{ $data->ReportingStartEnd }}</td>

                        <td class="bg-danger text-light fw-bolder">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Choose Action
                                </button>
                                <ul class="
                                dropdown-menu"
                                    aria-labelledby="dropdownMenuButton2">
                                    <li><a data-bs-toggle="modal" href="#Update{{ $data->id }}"
                                            class="dropdown-item">Update</a></li>
                                    <li><a data-msg="You want to disable this account. This action is  reversible!!"
                                            data-route="{{ route('MassDelete', ['id' => $data->id, 'TableName' => 'reporting_time_lines']) }}"
                                            class="dropdown-item deleteConfirm">Delete Record</a></li>


                                </ul>
                            </div>
                        </td>

                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>

</div>
@include('ReportingTimelines.New')




@isset($DataBaseData)
    @foreach ($DataBaseData as $up)
        {{ UpdateModalHeader($Title = 'Update the selected  record', $ModalID = $up->id) }}
        <form action="{{ route('MassUpdate') }}" class="" method="POST">
            @csrf

            <div class="row">

                <div class="mb-3 col-md-4">
                    <label id="label" for="ReportingQuarter" class="required mt-3 form-label">Select
                        Reporting Quarter
                    </label>
                    <select required name="ReportingQuarter" id="ReportingQuarter" class="form-select form-select-solid"
                        data-control="select2" data-placeholder="Select an option">
                        <option value="">Select an option</option>
                        <option value="Quarter 1">Quarter 1</option>
                        <option value="Quarter 2">Quarter 2</option>
                        <option value="Quarter 3">Quarter 3</option>
                        <option value="Quarter 4">Quarter 4</option>
                        <option value="Quarter 5">Quarter 5</option>
                        <option value="Quarter 6">Quarter 6</option>
                        <option value="Quarter 7">Quarter 7</option>
                        <option value="Quarter 8">Quarter 8</option>
                        <option value="Quarter 9">Quarter 9</option>
                        <option value="Quarter 10">Quarter 10</option>
                    </select>
                </div>



                <div class="mb-3 col-md-4">
                    <label id="label" for="ReportingYear" class="required mt-3 form-label">Reporting
                        Year</label>
                    <select required name="ReportingYear" id="ReportingYear" class="form-select form-select-solid"
                        data-control="select2" data-placeholder="Select an option">
                        <option value="{{ date('Y') }}">{{ date('Y') }}
                        </option>

                        @for ($i = date('Y') - 5; $i <= date('Y') + 10; $i++)
                            <option value="{{ $i }}">
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>




                <div class="mb-3 col-md-4">
                    <label id="label" for="ReportType" class="required mt-3 form-label">Reporting
                        Type</label>
                    <select required name="ReportType" id="ReportType" class="form-select form-select-solid"
                        data-control="select2" data-placeholder="Select an option">
                        <option value="Annual">Annual Report</option>
                        <option value="Quarterly">Quarterly Report</option>
                    </select>
                </div>




                <input type="hidden" name="id" value="{{ $up->id }}">

                <input type="hidden" name="TableName" value="reporting_time_lines">

                {{ RunUpdateModalFinal($ModalID = $up->id, $Extra = '', $csrf = null, $Title = null, $RecordID = $up->id, $col = '4', $te = '12', $TableName = 'reporting_time_lines') }}
            </div>


            {{ _UpdateModalFooter() }}

        </form>
    @endforeach
@endisset
