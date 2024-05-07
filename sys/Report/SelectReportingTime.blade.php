<div class="card-body shadow-lg pt-3 bg-light table-responsive">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('IndicatorWarning') }}" method="GET">
                <div class="mb-3 col-md-12  py-5   my-5">

                    <label class="px-5 my-5 required form-label">
                        Select the reporting timeframe to attach a report to.

                    </label>
                    <select required name="RID" class="form-select  py-5   my-5 form-select-solid"
                        data-control="select2" data-placeholder="Select a option">
                        <option></option>

                        @isset($Modules)
                            @foreach ($Modules as $data)
                                <option value="{{ $data->RID }}">

                                    {{ $data->ReportTitle }}

                                </option>
                            @endforeach
                        @endisset






                    </select>

                    <input type="hidden" name="Entity" value="{{ $Entity }}">
                </div>

                <div class="float-end my-3">
                    <button class="btn btn-danger btn-sm shadow-lg" type="submit">
                        Next
                    </button>
                </div>
            </form>


        </div>



    </div>


</div>
