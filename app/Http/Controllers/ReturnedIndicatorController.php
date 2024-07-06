<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ReturnedIndicatorController extends Controller
{

    public function ReturnedSelectEntity()
    {
        $DataBaseData = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->where('I.ApprovalStatus', 'Returned')
            ->select('P.Entity')
            ->get()->unique('Entity');

        // dd($DataBaseData);

        $data = [
            'Title' => 'Select Entity Reports With Returned Indicators',
            'Desc' => 'View Returned Indicators',
            'Page' => 'Returned.SelectEntity',
            'DataBaseData' => $DataBaseData,
            // 'Entity' => $Entity,
            // 'IndicatorPrimaryCategory' => $IndicatorPrimaryCategory,
            // 'Form' => $Form->Form('project_indicators'),

        ];

        return view('scrn', $data);
    }

    public function ReturnedSelectYear(Request $request)
    {
        $Entity = $request->Entity;
        $DataBaseData = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->join('reporting_time_lines as T', 'T.RID', 'I.RID')
            ->where('I.ApprovalStatus', "Returned")
            ->where('P.Entity', $Entity)
            ->select('T.*')
            ->get()->unique('T.ReportingYear');

        // dd($DataBaseData);

        $data = [
            'Title' => 'Select  Report Year For Review ' . $Entity,
            'Desc' => 'Indicator Report Review | Select Year ',
            'Page' => 'Returned.SelectYear',
            'DataBaseData' => $DataBaseData,
            'Entity' => $Entity,
            // 'Entity' => $Entity,
            // 'IndicatorPrimaryCategory' => $IndicatorPrimaryCategory,
            // 'Form' => $Form->Form('project_indicators'),

        ];

        return view('scrn', $data);
    }

    public function ReturnedSelectReport(Request $request)
    {

        $Entity = $request->Entity;
        $ReportYear = $request->ReportingYear;

        $DataBaseData = DB::table('indicator_reports_view')
            ->where('ApprovalStatus', "Returned")
            ->where('Entity', $Entity)
            ->where('ReportingYear', $ReportYear)
        // ->select()
            ->get()->unique('ReportTitle');

        // dd($DataBaseData);

        $data = [
            'Title' => 'Select  report  for review attached to the entity' . $Entity,
            'Desc' => 'Indicator Report Review | Report Selection ',
            'Page' => 'Returned.SelectReport',
            'DataBaseData' => $DataBaseData,
            'Entity' => $Entity,
            'ReportingYear' => $ReportYear,
            // 'Entity' => $Entity,
            // 'IndicatorPrimaryCategory' => $IndicatorPrimaryCategory,
            // 'Form' => $Form->Form('project_indicators'),

        ];

        return view('scrn', $data);

    }

    public function ReturnedIndicators(Request $request)
    {

        // dd($request);
        $Entity = $request->Entity;
        $ReportYear = $request->ReportingYear;
        $RID = $request->RID;

        $CRFPDO = DB::table('indicator_reports_view')

            ->where('ApprovalStatus', 'Returned')
            ->where('Entity', $Entity)
            ->where('IndicatorSecondaryCategory', "Country Specific Project Development Objective Indicators")
            ->where('ReportingYear', $ReportYear)
            ->where('RID', $RID)
            ->select('*', 'indicatorReportID AS ID')
            ->get();

        // dd($CRFPDO);

        $CRPITM = DB::table('indicator_reports_view')

            ->where('ApprovalStatus', 'Returned')
            ->where('Entity', $Entity)
            ->where('IndicatorSecondaryCategory', "Country Specific Intermediate Results Indicators")
            ->where('ReportingYear', $ReportYear)
            ->where('RID', $RID)
            ->select('*', 'indicatorReportID AS ID')
            ->get();

        // dd($CRPITM);

        $d = DB::table('reporting_time_lines')->where('RID', $RID)->first();

        $data = [
            'Title' => 'Review returned indicators for the selected entity: ' . $Entity,
            'Desc' => 'Only data for the report ' . $d->ReportTitle .
            ' for the year ' . $ReportYear .
            ' and the quarter ' . $d->ReportingQuarter . ' is shown',
            'Page' => 'Returned.Returned',
            'CRFPDO' => $CRFPDO,
            'CRPITM' => $CRPITM,
            'Entity' => $Entity,
            'report' => $d,
            'ReportYear' => $ReportYear,
            'RID' => $RID,
            // 'Entity' => $Entity,
            // 'IndicatorPrimaryCategory' => $IndicatorPrimaryCategory,
            // 'Form' => $Form->Form('project_indicators'),

        ];

        return view('scrn', $data);

    }

    public function FixReturned(Request $request)
    {
        // dd($request);
        $Entity = $request->Entity;
        $RID = $request->RID;
        $IID = $request->IID;
        $id = $request->ID;

        $del = DB::table('indicator_reports')->where('IID', $IID)->delete();

        $counter = DB::table('project_indicators AS I')
            ->where('I.Entity', $Entity)
        // ->where('I.ReportingPeriod', $report->ReportType)

            ->join('indicator_reports as R', 'R.IID', 'I.IID')
            ->where('I.IID', $IID)
            ->get();

        $report = DB::table('reporting_time_lines')->where('RID', $RID)->first();

        $RRF = DB::table('project_indicators')
            ->where('Entity', $Entity)
            ->where('ReportingPeriod', $report->ReportType)
            ->where('IndicatorPrimaryCategory', 'Regional Results Framework')
            ->get()->count();

        $CRF = DB::table('project_indicators')
            ->where('Entity', $Entity)
            ->where('ReportingPeriod', $report->ReportType)
            ->where('IndicatorPrimaryCategory', 'Country Specific Results Framework')
            ->get()->count();

        $IndicatorData = DB::table('project_indicators')
            ->where('Entity', $Entity)
            ->where('ReportingPeriod', $report->ReportType)
            ->where('IID', $IID)
            ->first();

        // dd($IndicatorData);

        $DataBaseData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.Entity', $Entity)
            ->where('T.RID', $RID)
            ->where('I.IID', $IID)
            ->where('T.ReportType', 'I.ReportingPeriod')
            ->select(
                'R.id',
                'T.ReportTitle',
                'T.ReportType',
                'T.ReportDescription',
                'T.ReportingYear',
                'T.ReportingQuarter',
                'R.Entity',
                'R.ReportedBy',
                'R.Response',
                'R.IndicatorResponsePercentageScore',
                'R.Comments',
                'I.id AS ProjectIndicatorId',
                'I.*',

            )
            ->get();

        $data = [
            'Title' => 'Indicator Reporting Form ' . $report->ReportTitle . ' | ' . $report->ReportDescription,
            'Desc' => "Report on the selected indicator",
            'Page' => 'Returned.Fix',
            'DataBaseData' => $DataBaseData,
            'IndicatorData' => $IndicatorData,
            // 'IndicatorData2' => $IndicatorData2,
            'Entity' => $Entity,
            'RRF' => $RRF,
            'CRF' => $CRF,
            'RID' => $RID,
            'Entity' => $Entity,
            'report' => $report,

        ];

        return view('scrn', $data);
    }

}
