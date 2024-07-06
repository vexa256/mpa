<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ReviewReports extends Controller
{

    public function PendingReportEntities()
    {
        $DataBaseData = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->where('I.ApprovalStatus', "false")
            ->select('P.Entity', 'I.*')
            ->get();

        $data = [
            'Title' => 'Select Entity Reports Pending Review',
            'Desc' => 'Review filled indicator reports',
            'Page' => 'Review.SelectEntity',
            'DataBaseData' => $DataBaseData,
            // 'Entity' => $Entity,
            // 'IndicatorPrimaryCategory' => $IndicatorPrimaryCategory,
            // 'Form' => $Form->Form('project_indicators'),

        ];

        return view('scrn', $data);

    }

    public function PendingReportSelectYear($Entity)
    {
        $DataBaseData = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->join('reporting_time_lines as T', 'T.RID', 'I.RID')
            ->where('I.ApprovalStatus', "false")
            ->where('P.Entity', $Entity)
            ->select('T.*', 'I.*')
            ->get();

        $data = [
            'Title' => 'Select  Report Year For Review ' . $Entity,
            'Desc' => 'Indicator Report Review | Select Year ',
            'Page' => 'Review.SelectYear',
            'DataBaseData' => $DataBaseData,
            'Entity' => $Entity,
            // 'Entity' => $Entity,
            // 'IndicatorPrimaryCategory' => $IndicatorPrimaryCategory,
            // 'Form' => $Form->Form('project_indicators'),

        ];

        return view('scrn', $data);

    }

    public function PendingReportSelectReport($Entity, $ReportYear)
    {
        $DataBaseData = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->join('reporting_time_lines as T', 'I.RID', 'I.RID')
            ->where('I.ApprovalStatus', "false")
            ->where('P.Entity', $Entity)
            ->where('T.ReportingYear', $ReportYear)
            ->select('T.*', 'I.*')
            ->get();

        $data = [
            'Title' => 'Select  Report  For Review ' . $Entity,
            'Desc' => 'Indicator Report Review | Report Selection ',
            'Page' => 'Review.SelectReport',
            'DataBaseData' => $DataBaseData,
            'Entity' => $Entity,
            'ReportYear' => $ReportYear,
            // 'Entity' => $Entity,
            // 'IndicatorPrimaryCategory' => $IndicatorPrimaryCategory,
            // 'Form' => $Form->Form('project_indicators'),

        ];

        return view('scrn', $data);

    }

    public function PendingReportViewIndicators($Entity, $ReportYear, $RID)
    {
        $CRFPDO = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->join('reporting_time_lines as T', 'I.RID', 'I.RID')
            ->where('I.ApprovalStatus', "false")
            ->where('P.Entity', $Entity)
            ->where('P.IndicatorSecondaryCategory', "Country Specific Project Development Objective Indicators")
            ->where('T.ReportingYear', $ReportYear)
            ->where('T.RID', $RID)
            ->select('T.*', 'I.*', 'P.*')
            ->get();

        $CRPITM = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->join('reporting_time_lines as T', 'I.RID', 'I.RID')
            ->where('I.ApprovalStatus', "false")
            ->where('P.IndicatorSecondaryCategory', "Country Specific Intermediate Results Indicators")
            ->where('P.Entity', $Entity)
            ->where('T.ReportingYear', $ReportYear)
            ->where('T.RID', $RID)
            ->select('T.*', 'I.*', 'P.*')
            ->get();

        $d = DB::table('reporting_time_lines')->where('RID', $RID)->first();

        $data = [
            'Title' => 'Review indicators for the selected entity: ' . $Entity,
            'Desc' => 'Only data for the report ' . $d->ReportTitle .
            ' for the year ' . $ReportYear . ' and the quarter ' . $d->ReportingQuarter,
            'Page' => 'Review.ViewIndicators',
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

    public function ReviewIndicator($Entity, $RID, $IID)
    {

        $report = DB::table('reporting_time_lines')->where('RID', $RID)->first();

        $IndicatorData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.Entity', $Entity)
            ->where('T.RID', $RID)
            ->where('R.ApprovalStatus', 'false')
            ->where('I.IID', $IID)
        // ->where('T.ReportType', 'I.ReportingPeriod')
            ->select(
                '*'
            )
            ->first();
        // dd($IndicatorData);

        $DataBaseData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.Entity', $Entity)
            ->where('T.RID', $RID)
            ->where('R.ApprovalStatus', 'false')
            ->where('I.IID', $IID)
            ->where('T.ReportType', 'I.ReportingPeriod')
            ->select('*')
            ->get();

        $data = [
            'Title' => 'Indicator Report Review ' . $report->ReportTitle . ' | ' . $report->ReportDescription,
            'Desc' => "Review the selected indicator",
            'Page' => 'Review.ViewSelectedIndicator',
            'DataBaseData' => $DataBaseData,
            'IndicatorData' => $IndicatorData,
            // 'IndicatorData2' => $IndicatorData2,
            'Entity' => $Entity,
            // 'RRF' => $RRF,
            // 'CRF' => $CRF,
            'RID' => $RID,
            'IID' => $IID,
            'Entity' => $Entity,
            'report' => $report,
            'tinMCE' => 'tinMCE',

        ];

        return view('scrn', $data);
    }

    public function ReturnIndicator(Request $request)
    {
        $validatedData = $request->validate([
            '*' => 'required',

        ]);

        $Year = DB::table('reporting_time_lines')->where('RID', $request->RID)
            ->first();

        DB::table('indicator_reports')->where('IID', $request->IID)

            ->update([
                "ReasonForReturningTheIndicator" =>
                $request->ReasonForReturningTheIndicator,
                "ApprovalStatus" => "Returned",
            ]);

        return redirect()->route('PendingReportViewIndicators', [
            'Entity' => $request->Entity,
            'ReportYear' => $Year->ReportingYear,
            'RID' => $request->RID,
        ])->with('status', 'Indicator Returned To Reporting Entity Successfully');

    }

    public function ApproveIndicator(Request $request)
    {
        $validatedData = $request->validate([
            '*' => 'required',
        ]);

        $Year = DB::table('reporting_time_lines')->where('RID', $request->RID)
            ->first();

        DB::table('indicator_reports')->where('IID', $request->IID)

            ->update([
                "ApprovalStatus" => "Approved",
            ]);

        return redirect()->route('PendingReportViewIndicators', [
            'Entity' => $request->Entity,
            'ReportYear' => $Year->ReportingYear,
            'RID' => $request->RID,
        ])->with('status', 'Indicator Approved Successfully');

    }

    public function ApprovedIndicatorsSelectEntity()
    {
        $Entity = DB::table('entities AS E')
            ->join('indicator_reports  AS I', 'I.Entity', 'E.Entity')
            ->where('ApprovalStatus', 'Approved')
            ->get()->unique('Entity');

        // dd($Entity);

        $data = [
            'Title' => 'Select Entity',
            'Desc' => 'View approved indicators',
            'Page' => 'Review.ApprovedSelectEntity',
            'DataBaseData' => $Entity,
        ];

        return view('scrn', $data);
    }

    public function ApprovedIndicatorYear(Request $request)
    {
        // dd($request->$Entity);

        $Entity = DB::table('entities AS E')
            ->join('indicator_reports  AS I', 'I.Entity', 'E.Entity')
            ->join('reporting_time_lines  AS T', 'T.RID', 'I.RID')
            ->where('I.ApprovalStatus', 'Approved')
            ->where('E.Entity', $request->Entity)
            ->get()->unique('Entity');

        $data = [
            'Title' => 'Select Report Years',
            'Desc' => 'View approved indicators',
            'Page' => 'Review.ApprovedSelectYear',
            'DataBaseData' => $Entity,
            'Entity' => $request->Entity,
        ];

        return view('scrn', $data);
    }

    public function ApprovedIndicatorReport(Request $request)
    {

        $Entity = DB::table('entities AS E')
            ->join('indicator_reports  AS I', 'I.Entity', 'E.Entity')
            ->join('reporting_time_lines  AS T', 'T.RID', 'I.RID')
            ->where('I.ApprovalStatus', 'Approved')
            ->where('E.Entity', $request->Entity)
            ->where('T.ReportingYear', $request->ReportingYear)
            ->get()->unique('Entity');

        $data = [
            'Title' => 'Select Report Years',
            'Desc' => 'View approved indicators',
            'Page' => 'Review.ApprovedSelectReport',
            'DataBaseData' => $Entity,
            'Entity' => $request->Entity,
            'ReportingYear' => $request->ReportingYear,
        ];

        return view('scrn', $data);
    }

    public function ApprovedReportViewIndicators(Request $request)
    {
        // dd($request);
        $Entity = $request->Entity;
        $ReportYear = $request->ReportingYear;
        $RID = $request->RID;

        $CRFPDO = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->join('reporting_time_lines as T', 'T.RID', 'I.RID')
            ->where('I.ApprovalStatus', 'Approved')
            ->where('P.Entity', $Entity)
            ->where('P.IndicatorSecondaryCategory', "Country Specific Project Development Objective Indicators")
            ->where('T.ReportingYear', $ReportYear)
            ->where('T.RID', $RID)
            ->select('*', 'I.id AS ID')
            ->get();

        // dd($CRFPDO);

        $CRPITM = DB::table('indicator_reports AS I')
            ->join('project_indicators as P', 'P.IID', 'I.IID')
            ->join('reporting_time_lines as T', 'T.RID', 'I.RID')
            ->where('I.ApprovalStatus', 'Approved')
            ->where('P.Entity', $Entity)
            ->where('P.IndicatorSecondaryCategory', "Country Specific Intermediate Results Indicators")
            ->where('T.ReportingYear', $ReportYear)
            ->where('T.RID', $RID)
            ->select('*', 'I.id AS ID')
            ->get();

        // dd($CRPITM);

        $d = DB::table('reporting_time_lines')->where('RID', $RID)->first();

        $data = [
            'Title' => 'Review indicators for the selected entity: ' . $Entity,
            'Desc' => 'Only data for the report ' . $d->ReportTitle .
            ' for the year ' . $ReportYear . ' and the quarter ' . $d->ReportingQuarter,
            'Page' => 'Review.ViewApproved',
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

    public function ViewIndicatorApproved(Request $request)
    {

        $Entity = $request->Entity;
        $RID = $request->RID;
        $IID = $request->RID;

        // dd($request);

        $report = DB::table('reporting_time_lines')->where('RID', $RID)->first();

        $IndicatorData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.id', $request->ID)
        // ->where('T.RID', $RID)
        // ->where('R.ApprovalStatus', 'Approved')
        // ->where('I.IID', $IID)
        // ->where('T.ReportType', 'I.ReportingPeriod')
            ->select(
                '*'
            )
            ->first();

        $data = [
            'Title' => 'Approved Indicator ' . $report->ReportTitle . ' | ' . $report->ReportDescription,
            'Desc' => "View the selected  Approved indicator",
            'Page' => 'Review.SelectedApproved',
            // 'DataBaseData' => $DataBaseData,
            'IndicatorData' => $IndicatorData,
            // 'IndicatorData2' => $IndicatorData2,
            'Entity' => $Entity,
            // 'RRF' => $RRF,
            // 'CRF' => $CRF,
            'RID' => $RID,
            'IID' => $IID,
            'Entity' => $Entity,
            'report' => $report,
            'tinMCE' => 'tinMCE',

        ];

        return view('scrn', $data);
    }

}
