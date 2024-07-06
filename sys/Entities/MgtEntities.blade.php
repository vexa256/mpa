<!--begin::Card body-->
<div class="card-body pt-3  fw-bolder text-white shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = 'Entity/Country Database',
        $Msg = 'Add and remove countries/entities that report on indicators',
    ) !!}
</div>


@isset($DataBaseData)
    @foreach ($DataBaseData as $up)
        {{ UpdateModalHeader($Title = 'Update the selected  record', $ModalID = $up->id) }}
        <form action="{{ route('MassUpdate') }}" class="" method="POST">
            @csrf

            <div class="row">





                <input type="hidden" name="id" value="{{ $up->id }}">

                <input type="hidden" name="TableName" value="entities">

                {{ RunUpdateModalFinal($ModalID = $up->id, $Extra = '', $csrf = null, $Title = null, $RecordID = $up->id, $col = '12', $te = '12', $TableName = 'entities') }}
            </div>


            {{ _UpdateModalFooter() }}

        </form>
    @endforeach
@endisset

{{-- @include('Indicators.New') --}}
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Entity', $Icon = 'fa-plus') }}
    <table class="mytable table table-rounded table-bordered border gy-3 gs-3">
        <thead>
            <tr>
                <th class="bg-dark text-light fw-bolder">Entity Name</th>
                {{-- <th class="bg-dark text-light fw-bolder">Entity ID</th> --}}
                {{-- <th class="bg-dark text-light fw-bolder">Project Details</th> --}}
                <th class="bg-dark text-light fw-bolder">Date Created</th>
                <th class="bg-dark text-light fw-bolder">Update</th>
                <th class="bg-dark text-light fw-bolder">Etity Details</th>

                <th class="bg-danger text-light fw-bolder">Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($DataBaseData as $data)
                <tr>
                    <td class="bg-dark fw-bolder text-light">{{ $data->Entity }}</td>
                    {{-- <td class="bg-secondary text-dark fw-bolder">{{ $data->EntityID }}</td>
                    <td class="text-dark fw-bolder">{{ $data->EntityProjectDetails }}</td> --}}
                    <td class="text-light fw-bolder bg-primary">{{ date('F j, Y', strtotime($data->created_at)) }}</td>



                    <td>

                        <a data-bs-toggle="modal" class="btn shadow-lg btn-dark btn-sm admin"
                            href="#Update{{ $data->id }}">

                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </a>

                    </td>


                    <td>
                        <a data-bs-toggle="modal" class="btn btn-danger btn-sm" href="#ViewDesc{{ $data->id }}">

                            <i class="fas fa-binoculars" aria-hidden="true"></i>
                        </a>

                    </td>


                    <td>

                        {!! ConfirmBtn(
                            $data = [
                                'msg' => 'You want to delete this record',
                                'route' => route('MassDelete', [
                                    'id' => $data->id,
                                    'TableName' => 'entities',
                                ]),
                                'label' => '<i class="fas fa-trash"></i>',
                                'class' => 'btn btn-danger btn-sm deleteConfirm',
                            ],
                        ) !!}

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>


</div>



{{ DescModal($DataBaseData, $Title = 'View the more details  attached to selected entity ', $ModalID = 'ViewDesc', $col = 'EntityProjectDetails') }}






@include('Entities.NewEntity')
