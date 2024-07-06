<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormEngine;
use DB;
use Illuminate\Http\Request;

class AppController extends Controller
{

    public function MgtEntities()
    {

        $DataBaseData = DB::table('entities')
            ->get();
        $Form = new FormEngine;

        $rem = [
            "updated_at",
            "created_at",
            "id",
            "EntityID",
        ];

        $data = [
            'Title' => 'Project Entity/Countries',
            'Desc' => 'Set entities to report on indicators',
            'Page' => 'Entities.MgtEntities',
            'DataBaseData' => $DataBaseData,
            'rem' => $rem,

            'Form' => $Form->Form('entities'),

        ];

        return view('scrn', $data);
    }
    public function MgtIndicators(Request $request)
    {

        $Entity = $request->Entity;
        $IndicatorPrimaryCategory = $request->IndicatorPrimaryCategory;

        $DataBaseData = DB::table('project_indicators')
            ->where('IndicatorPrimaryCategory', $IndicatorPrimaryCategory)
            ->where('Entity', $Entity)
            ->get();

        // dd($DataBaseData);

        $Form = new FormEngine;

        $data = [
            'Title' => 'Manage Project Indicators for the entity ' . $Entity,
            'Desc' => 'The selected indicator category is ' . $IndicatorPrimaryCategory,
            'Page' => 'Indicators.MgtIndicators',
            'DataBaseData' => $DataBaseData,
            'Entity' => $Entity,
            'IndicatorPrimaryCategory' => $IndicatorPrimaryCategory,
            'Form' => $Form->Form('project_indicators'),

        ];

        return view('scrn', $data);
    }

    public function SelectEntity()
    {

        $Modules = DB::table('project_indicators')->get();

        $data = [
            'Title' => 'Select Reporting Entity',
            'Desc' => 'Project Indicator Settings',
            'Page' => 'Indicators.SelectEntity',
            'Modules' => $Modules,

        ];

        return view('scrn', $data);
    }

    public function SelectIndicatorCategory(Request $request)
    {

        $Entity = $request->Entity;

        $Modules = DB::table('project_indicators')
            ->where('Entity', $Entity)->get();

        $data = [
            'Title' => 'Select Indictor Category',
            'Desc' => 'Project Indicator Settings',
            'Page' => 'Indicators.SelectCategory',
            'Modules' => $Modules,
            'Entity' => $Entity,

        ];

        return view('scrn', $data);
    }

    public function CreateIndicator(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'Indicator' => 'required|string',
            'ReportingToolResponses.*' => 'nullable|string', // Validates each item in the array
            'RemarksComments' => 'nullable|string',
            'SourceOfData' => 'required|string',
            'ReportingRequirements' => 'required|string',
            'ResponseType' => 'required|string',
            'IndicatorPrimaryCategory' => 'required|string',
            'Entity' => 'required|string',
        ]);

        // Encode the ReportingToolResponses as JSON if it is not null
        $reportingToolResponses = $request->has('ReportingToolResponses') ? json_encode($request->ReportingToolResponses) : null;

        // Insert data into the 'project_indicators' table
        DB::table('project_indicators')->insert([
            'Indicator' => $request->Indicator,
            'ReportingToolResponses' => $reportingToolResponses,
            'RemarksComments' => $request->RemarksComments,
            'IndicatorPrimaryCategory' => $request->IndicatorPrimaryCategory,
            'IndicatorSecondaryCategory' => $request->IndicatorSecondaryCategory,
            'ReportingPeriod' => $request->ReportingPeriod,
            'SourceOfData' => $request->SourceOfData,
            'ReportingRequirements' => $request->ReportingRequirements,
            'ResponseType' => $request->ResponseType,
            'Entity' => $request->Entity,
            'IID' => md5(uniqid() . 'AFC' . now()),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Indicator submitted successfully!');
    }

    public function MgtReportingTimelines(Request $request)
    {
        $DataBaseData = DB::table('reporting_time_lines')->get();

        $Form = new FormEngine;
        $rem = [

            'created_at',
            'updated_at',
            'id',
            'RID',
            'ReportType',
            'ReportingType',
            'ReportingQuarter',
            'ReportingYear',

        ];
        $data = [
            'Title' => 'Reporting timeline settings',
            'Desc' => 'Set reporting parameters',
            'Page' => 'ReportingTimelines.MgtReportingTimelines',
            'DataBaseData' => $DataBaseData,
            'rem' => $rem,
            'Form' => $Form->Form('reporting_time_lines'),

        ];

        return view('scrn', $data);
    }

    public function ReportSelectEntity()
    {
        $Modules = DB::table('project_indicators')->get();

        $data = [
            'Title' => 'Select entity  ',
            'Desc' => 'Select entity to report on',
            'Page' => 'Report.SelectEntity',
            'Modules' => $Modules,

        ];

        return view('scrn', $data);
    }

    public function ReportSelectReportingTimeFrame(Request $request)
    {
        $Modules = DB::table('reporting_time_lines')->get();

        $Entity = $request->Entity;

        $data = [
            'Title' => 'Select reporting time frame',
            'Desc' => 'Reporting timeframes for the entity ' . $Entity,
            'Page' => 'Report.SelectReportingTime',
            'Modules' => $Modules,
            'Entity' => $Entity,

        ];

        return view('scrn', $data);
    }

    public function IndicatorWarning()
    {
        // $Modules = DB::table('project_indicators')
        //     ->where('Entity', $Entity)
        //     ->get();

        // $Entity = $request->Entity;

        $data = [
            'Title' => 'Incomplete Indicator Database',
            'Desc' => 'Please fill in all the required indicators for all entities',
            'Page' => 'temp',

        ];

        return view('scrn', $data);
    }

    public function ReportSelectCategory(Request $request)
    {
        $Modules = DB::table('project_indicators')
            ->where('Entity', $Entity)
            ->get();

        $Entity = $request->Entity;

        $data = [
            'Title' => 'Select reporting time frame',
            'Desc' => 'Reporting timeframes for the entity ' . $Entity,
            'Page' => 'Report.SelectReportingTime',
            'Modules' => $Modules,
            'Entity' => $Entity,

        ];

        return view('scrn', $data);
    }

    public function FileReport(Request $request)
    {

        $Entity = $request->Entity;
        $RID = $request->RID;

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

        $DataBaseData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.Entity', $Entity)
            ->where('T.RID', $RID)
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
            'Title' => 'Indicator Reporting Dashboard ' . $report->ReportTitle . ' | ' . $report->ReportDescription,
            'Desc' => "Report on indicators",
            ' | File indicator reports',
            'Page' => 'Report.Report',
            'DataBaseData' => $DataBaseData,
            // 'Entity' => $Entity,
            'RRF' => $RRF,
            'CRF' => $CRF,
            'report' => $report,
            'Entity' => $Entity,
            'RID' => $RID,

        ];

        return view('scrn', $data);
    }

    public function RRF($Entity, $RID)
    {

        // $Entity = $request->Entity;
        // $RID = $request->RID;

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
            ->leftJoin('indicator_reports', 'project_indicators.IID', '=', 'indicator_reports.IID')
            ->where('project_indicators.Entity', $Entity)
            ->where('project_indicators.ReportingPeriod', $report->ReportType)
            ->where('project_indicators.IndicatorPrimaryCategory', 'Regional Results Framework')
            ->where('project_indicators.IndicatorSecondaryCategory', 'Regional Project Development Objective Indicators')
            ->whereNull('indicator_reports.IID')
            ->select('project_indicators.*')
            ->get();

        $IndicatorData2 = DB::table('project_indicators')
            ->leftJoin('indicator_reports', 'project_indicators.IID', '=', 'indicator_reports.IID')
            ->where('project_indicators.Entity', $Entity)
            ->where('project_indicators.ReportingPeriod', $report->ReportType)
            ->where('project_indicators.IndicatorPrimaryCategory', 'Regional Results Framework')
            ->where('project_indicators.IndicatorSecondaryCategory', 'Regional Intermediate Results Indicators')
            ->whereNull('indicator_reports.IID')
            ->select('project_indicators.*')
            ->get();

        // $IndicatorData3 = DB::table('project_indicators')
        //     ->where('Entity', $Entity)
        //     ->where('ReportingPeriod', $report->ReportType)
        //     ->where('IndicatorSecondaryCategory',
        //         'Country Specific Intermediate Results Indicators')
        //     ->get();

        // $IndicatorData4 = DB::table('project_indicators')
        //     ->where('Entity', $Entity)
        //     ->where('ReportingPeriod', $report->ReportType)
        //     ->where('IndicatorSecondaryCategory',
        //         'Country Specific Project Development Objective Indicators')
        //     ->get();

        $DataBaseData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.Entity', $Entity)
            ->where('T.RID', $RID)
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
            'Title' => 'Indicator Reporting Dashboard ' . $report->ReportTitle . ' | ' . $report->ReportDescription,
            'Desc' => "Report on indicators",
            ' | File indicator reports',
            'Page' => 'Report.RRF',
            'DataBaseData' => $DataBaseData,
            'IndicatorData' => $IndicatorData,
            'IndicatorData2' => $IndicatorData2,
            'Entity' => $Entity,
            'RRF' => $RRF,
            'CRF' => $CRF,
            'RID' => $RID,

            'RRF' => $RRF,
            'CRF' => $CRF,
            'report' => $report,
            'Entity' => $Entity,
            'RID' => $RID,
            // 'Entity' => $Entity,
            'report' => $report,

        ];

        return view('scrn', $data);
    }

    public function ReportRRF($Entity, $RID, $id)
    {

        $counter = DB::table('project_indicators AS I')
            ->where('I.Entity', $Entity)
        // ->where('I.ReportingPeriod', $report->ReportType)
            ->where('I.id', $id)
            ->join('indicator_reports as R', 'R.IID', 'I.IID')
            ->get();

        if ($counter->count() > 0) {

            return redirect()->route('RRF', ['Entity' => $Entity, 'RID' => $RID])
                ->with('status', 'This indicator has  been reported as per this report');

            die();
        }

        // $Entity = $request->Entity;
        // $RID = $request->RID;

        {
            $report = DB::table('reporting_time_lines')->where('RID', $RID)->first();
        }

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
            ->where('id', $id)
            ->first();

        $DataBaseData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.Entity', $Entity)
            ->where('T.RID', $RID)
            ->where('I.id', $id)
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
            'Page' => 'Report.ReportRRF',
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

    public function CF($Entity, $RID)
    {

        // $Entity = $request->Entity;
        // $RID = $request->RID;

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
            ->leftJoin('indicator_reports', 'project_indicators.IID', '=', 'indicator_reports.IID')
            ->where('project_indicators.Entity', $Entity)
            ->where('project_indicators.ReportingPeriod', $report->ReportType)
            ->where('project_indicators.IndicatorPrimaryCategory', 'Country Specific Results Framework')
            ->where('project_indicators.IndicatorSecondaryCategory', 'Country Specific Project Development Objective Indicators')
            ->whereNull('indicator_reports.IID')
            ->select('project_indicators.*')
            ->get();

        $IndicatorData2 = DB::table('project_indicators')
            ->leftJoin('indicator_reports', 'project_indicators.IID', '=', 'indicator_reports.IID')
            ->where('project_indicators.Entity', $Entity)
            ->where('project_indicators.ReportingPeriod', $report->ReportType)
            ->where('project_indicators.IndicatorPrimaryCategory', 'Country Specific Results Framework')
            ->where('project_indicators.IndicatorSecondaryCategory', 'Country Specific Intermediate Results Indicators')
            ->whereNull('indicator_reports.IID')
            ->select('project_indicators.*')
            ->get();

        // $IndicatorData3 = DB::table('project_indicators')
        //     ->where('Entity', $Entity)
        //     ->where('ReportingPeriod', $report->ReportType)
        //     ->where('IndicatorSecondaryCategory',
        //         'Country Specific Intermediate Results Indicators')
        //     ->get();

        // $IndicatorData4 = DB::table('project_indicators')
        //     ->where('Entity', $Entity)
        //     ->where('ReportingPeriod', $report->ReportType)
        //     ->where('IndicatorSecondaryCategory',
        //         'Country Specific Project Development Objective Indicators')
        //     ->get();

        $DataBaseData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.Entity', $Entity)
            ->where('T.RID', $RID)
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
            'Title' => 'Indicator Reporting Dashboard ' . $report->ReportTitle . ' | ' . $report->ReportDescription,
            'Desc' => "Report on indicators",
            ' | File indicator reports',
            'Page' => 'Report.CF',
            'DataBaseData' => $DataBaseData,
            'IndicatorData' => $IndicatorData,
            'IndicatorData2' => $IndicatorData2,
            'Entity' => $Entity,
            'RRF' => $RRF,
            'CRF' => $CRF,
            'RID' => $RID,

            'RRF' => $RRF,
            'CRF' => $CRF,
            'report' => $report,
            'Entity' => $Entity,
            'RID' => $RID,
            // 'Entity' => $Entity,
            'report' => $report,

        ];

        return view('scrn', $data);
    }

    public function ReportCF($Entity, $RID, $id)
    {

        $counter = DB::table('project_indicators AS I')
            ->where('I.Entity', $Entity)
        // ->where('I.ReportingPeriod', $report->ReportType)
            ->where('I.id', $id)
            ->join('indicator_reports as R', 'R.IID', 'I.IID')
            ->get();

        if ($counter->count() > 0) {

            return redirect()->route('CF', ['Entity' => $Entity, 'RID' => $RID])
                ->with('status', 'This indicator has  been reported as per this report');

            // die();
        }

        // $Entity = $request->Entity;
        // $RID = $request->RID;

        {
            $report = DB::table('reporting_time_lines')->where('RID', $RID)->first();
        }

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
            ->where('id', $id)
            ->first();

        $DataBaseData = DB::table('reporting_time_lines AS T')
            ->join('indicator_reports AS R', 'T.RID', 'R.RID')
            ->join('project_indicators AS I', 'I.IID', 'R.IID')
            ->where('R.Entity', $Entity)
            ->where('T.RID', $RID)
            ->where('I.id', $id)
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
            'Page' => 'Report.ReportCF',
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

    public function Dashboard()
    {

        $r = DB::table('indicator_reports')->count();

        $Total = DB::table('project_indicators')->count();

        $Entities = DB::table('entities')->count();

        $RRFReported = DB::table('indicator_reports AS R')
            ->join('project_indicators AS P', 'P.IID', 'R.IID')
            ->where('P.IndicatorPrimaryCategory', 'Regional Results Framework')
            ->count();

        $CRFReported = DB::table('indicator_reports AS R')
            ->join('project_indicators AS P', 'P.IID', 'R.IID')
            ->where('P.IndicatorPrimaryCategory', 'Country Specific Results Framework')
            ->count();

        $TotalCRF = DB::table('project_indicators')
            ->where('IndicatorPrimaryCategory', 'Country Specific Results Framework')
            ->count();

        $TotalRRF = DB::table('project_indicators')
            ->where('IndicatorPrimaryCategory', 'Regional Results Framework')
            ->count();

        $TotalReviewed = DB::table('indicator_reports')
            ->where('ApprovalStatus', 'true')
            ->count();

        $TotalRejected = DB::table('indicator_reports')
            ->where('ApprovalStatus', 'false')
            ->count();

        $data = [
            'Title' => 'Dashboard Analytics as of this reporting quarter',
            'Desc' => "Analytics for this quarter 2024",
            'Page' => 'Report.Dashboard',
            'r' => $r,
            'Total' => $Total,
            'Entities' => $Entities,
            'RRFReported' => $RRFReported,
            'CRFReported' => $CRFReported,
            'TotalCRF' => $TotalCRF,
            'TotalRRF' => $TotalRRF,
            'TotalReviewed' => $TotalReviewed,
            'TotalRejected' => $TotalRejected,

        ];

        return view('scrn', $data);

    }

}
