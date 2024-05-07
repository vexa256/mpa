<div class="card-body shadow-lg pt-3 bg-light table-responsive">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('MgtIndicators') }}" method="GET">
                <div class="mb-3 col-md-12  py-5   my-5">

                    <label class="px-5 my-5 required form-label">
                        Select
                        Indicator Category to
                        Manage.
                        These are indicator
                        catgeories for the entity
                        ({{ $Entity }})

                    </label>
                    <select required name="IndicatorPrimaryCategory" class="form-select  py-5   my-5 form-select-solid"
                        data-control="select2" data-placeholder="Select a option">
                        <option></option>

                        <option value="Country Specific Results Framework">
                            Country Specific Results Framework </option>

                        <option value="Regional Results Framework">
                            Regional Results Framework
                        </option>





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
