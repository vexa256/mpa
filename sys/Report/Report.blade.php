<!--begin::Card body-->
<div class="card-body pt-3  fw-bolder text-white shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = 'MPA M&E Indicators for the entity ' . $Entity,
        $Msg = $IndicatorPrimaryCategory . '  Indicator settings',
    ) !!}
</div>

@include('Indicators.New')
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Indicator', $Icon = 'fa-plus') }}
    <table class="mytable table table-rounded table-bordered border gy-3 gs-3">
        <thead>
            <tr>
                <th class="bg-dark text-light fw-bolder">Entity</th>
                <th class="bg-dark text-light fw-bolder"> Category</th>
                <th class="bg-dark text-light fw-bolder"> Type</th>
                {{-- <th >Secondary Category</th> --}}
                <th class="bg-warning fw-bolder text-dark">Indicator</th>
                <th class="bg-dark text-light fw-bolder">Reporting Tool </th>
                {{-- <th >Remarks Comments</th> --}}
                <th class="bg-dark text-light fw-bolder">Source of Data</th>
                <th class="bg-dark text-light fw-bolder">Reporting Requirements</th>
                <th class="bg-danger text-light fw-bolder">Delete</th>
            </tr>
        </thead>


        <tbody>
            @foreach ($DataBaseData as $data)
                <tr>
                    <td class="bg-dark fw-bolder text-light">{{ $data->Entity }}</td>
                    <td class="bg-secondary text-dark fw-bolder">{{ $data->IndicatorPrimaryCategory }}</td>
                    <td class="text-dark fw-bolder">{{ $data->IndicatorSecondaryCategory }}</td>
                    <td class="bg-success fw-bolder text-dark">{{ $data->Indicator }}</td>
                    <td class="text-light fw-bolder bg-primary">
                        @php
                            $responses = json_decode($data->ReportingToolResponses, true);
                        @endphp
                        <ul>
                            @foreach ($responses as $index => $response)
                                <li>{{ $index + 1 }}. {{ $response }}</li>
                            @endforeach
                        </ul>
                    </td>
                    {{-- <td >{{ $data->RemarksComments }}</td> --}}
                    <td class="text-danger fw-bolder">{{ $data->SourceOfData }}</td>
                    <td class="text-danger fw-bolder">{{ $data->ReportingRequirements }}</td>
                    <td>


                        {!! ConfirmBtn(
                            $data = [
                                'msg' => 'You want to delete this record',
                                'route' => route('MassDelete', [
                                    'id' => $data->id,
                                    'TableName' => 'project_indicators',
                                ]),
                                'label' => ' <i class="fas fa-trash"></i>',
                                'class' => 'btn btn-danger btn-sm deleteConfirm',
                            ],
                        ) !!}


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
