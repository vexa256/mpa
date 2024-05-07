<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title">Create a new reporting timeframe and report
                    {{-- 
                    <span class="text-danger">
                        {{ $ModuleName }}
                    </span>
 --}}


                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <form action="{{ route('MassInsert') }}" class="row" method="POST">
                    @csrf

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label id="label" for="ReportingQuarter" class="required mt-3 form-label">Select
                                Reporting Quarter
                            </label>
                            <select required name="ReportingQuarter" id="ReportingQuarter"
                                class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select an option">
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
                            <select required name="ReportingYear" id="ReportingYear"
                                class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select an option">
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



                        @foreach ($Form as $data)
                            @if ($data['type'] == 'string')
                                {{ CreateInputText($data, $placeholder = null, $col = '4') }}
                            @elseif (
                                'smallint' == $data['type'] ||
                                    'bigint' === $data['type'] ||
                                    'integer' == $data['type'] ||
                                    'float' == $data['type'] ||
                                    'decimal' == $data['type'] ||
                                    'bigint' == $data['type']
                            )
                                {{ CreateInputInteger($data, $placeholder = null, $col = '4') }}
                            @elseif ($data['type'] == 'date' || $data['type'] == 'datetime')
                                {{ CreateInputDate($data, $placeholder = null, $col = '4') }}
                            @endif
                        @endforeach

                    </div>

                    <div class="row">
                        @foreach ($Form as $data)
                            @if ($data['type'] == 'text')
                                {{ CreateInputEditor($data, $placeholder = null, $col = '12') }}
                            @endif
                        @endforeach

                    </div>


                    <input required type="hidden" name="RID"
                        value="{{ md5(\Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S'))) }}">



                    <input required type="hidden" name="TableName" value="reporting_time_lines">





            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-dark">Save
                    Changes</button>

                </form>
            </div>

        </div>
    </div>
</div>
