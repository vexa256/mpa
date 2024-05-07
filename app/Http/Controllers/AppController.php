<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormEngine;
use DB;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function MgtIndicators(Request $request)
    {

        $Entity = $request->Entity;
        $IndicatorPrimaryCategory = $request->IndicatorPrimaryCategory;

        $DatabaseData = DB::table('project_indicators')
            ->where('IndicatorPrimaryCategory', $IndicatorPrimaryCategory)
            ->where('Entity', $Entity)
            ->get();

        $Form = new FormEngine;

        $data = [
            'Title' => 'Manage Project Indicators for the entity ' . $Entity,
            'Desc' => 'The selected indicator category is ' . $IndicatorPrimaryCategory,
            'Page' => 'Indicators.MgtIndicators',
            'DataBaseData' => $DatabaseData,
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
        $DatabaseData = DB::table('reporting_time_lines')->get();

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
            'DatabaseData' => $DatabaseData,
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
        $Modules = DB::table('reporting_time_lines')->get();

        $Entity = $request->Entity;
        $RID = $request->RID;

        $data = [
            'Title' => 'Select reporting time frame',
            'Desc' => 'Reporting timeframes for the entity ' . $Entity,
            'Page' => 'Report.SelectReportingTime',
            'Modules' => $Modules,
            'Entity' => $Entity,

        ];

        return view('scrn', $data);
    }
}
