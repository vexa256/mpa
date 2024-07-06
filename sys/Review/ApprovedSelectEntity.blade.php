<!--begin::Card body-->
<div class="card-body pt-3 bg-light table-responsive">
</div>
<div class="card-body shadow-lg pt-3 bg-light table-responsive">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('ApprovedIndicatorYear') }}" method="GET">
                @csrf
                <div class="mb-3 col-md-12  py-5   my-5">
                    <label id="label" for="" class="px-5 my-5 required form-label">Select
                        Entity | Only entities with returned indicators are shown</label>
                    <select required name="Entity" class="form-select  py-5   my-5 form-select-solid"
                        data-control="select2" data-placeholder="Select a option">
                        <option></option>
                        @isset($DataBaseData)

                            @foreach ($DataBaseData as $data)
                                <option value="{{ $data->Entity }}">

                                    {{ $data->Entity }}

                                </option>
                            @endforeach

                        @endisset

                    </select>

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
