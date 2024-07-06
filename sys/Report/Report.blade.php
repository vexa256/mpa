<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-danger',
        $Title =
            'Indicator Reporting Dashboard MPA project | 
                                                                                                                                                                                                                                    ' .
            $report->ReportTitle .
            ' | ' .
            $report->ReportDescription,
        $Msg = 'Only ' . $report->ReportType . ' reported indicators are shown here',
    ) !!}
</div>
@include('Report.ReportPanel')
<div class="container">
    <div class="row ">

        <div class="col-6">
            <!-- Button floating to the left -->
            <a href="{{ route('RRF', ['Entity' => $Entity, 'RID' => $RID]) }}" class="btn btn-danger float-start">
                <i class="fas fa-arrow-right me-2" aria-hidden="true"></i> RRF
            </a>
        </div>
        <div class="col-6">
            <!-- Button floating to the right -->
            <a href="{{ route('CF', ['Entity' => $Entity, 'RID' => $RID]) }}" class="btn btn-danger float-end">
                CRF <i class="fas fa-arrow-left ms-2" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>
