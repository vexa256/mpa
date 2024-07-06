<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnedIndicatorController;
use App\Http\Controllers\ReviewReports;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::middleware(['auth'])->group(function () {

    Route::any('FixReturned',
        [ReturnedIndicatorController::class, 'FixReturned'])
        ->name('FixReturned');

    Route::any('ReturnedIndicators',
        [ReturnedIndicatorController::class, 'ReturnedIndicators'])
        ->name('ReturnedIndicators');

    Route::any('ReturnedSelectReport',
        [ReturnedIndicatorController::class, 'ReturnedSelectReport'])
        ->name('ReturnedSelectReport');

    Route::any('ReturnedSelectYear',
        [ReturnedIndicatorController::class, 'ReturnedSelectYear'])
        ->name('ReturnedSelectYear');

    Route::any('ReturnedSelectEntity',
        [ReturnedIndicatorController::class, 'ReturnedSelectEntity'])
        ->name('ReturnedSelectEntity');

    Route::any('ViewIndicatorApproved',
        [ReviewReports::class, 'ViewIndicatorApproved'])
        ->name('ViewIndicatorApproved');

    Route::any('ApprovedReportViewIndicators',
        [ReviewReports::class, 'ApprovedReportViewIndicators'])
        ->name('ApprovedReportViewIndicators');

    Route::any('ApprovedIndicatorReport',
        [ReviewReports::class, 'ApprovedIndicatorReport'])
        ->name('ApprovedIndicatorReport');

    Route::any('ApprovedIndicatorYear',
        [ReviewReports::class, 'ApprovedIndicatorYear'])
        ->name('ApprovedIndicatorYear');

    Route::any('ApprovedIndicatorsSelectEntity',
        [ReviewReports::class, 'ApprovedIndicatorsSelectEntity'])
        ->name('ApprovedIndicatorsSelectEntity');

    Route::post('ApproveIndicator',
        [ReviewReports::class, 'ApproveIndicator'])
        ->name('ApproveIndicator');

    Route::post('ReturnIndicator',
        [ReviewReports::class, 'ReturnIndicator'])
        ->name('ReturnIndicator');

    Route::get('ReviewIndicator/{Entity}/{RID}/{IID}',
        [ReviewReports::class, 'ReviewIndicator'])
        ->name('ReviewIndicator');

    Route::get('PendingReportViewIndicators/{Entity}/{ReportYear}/{RID}',
        [ReviewReports::class, 'PendingReportViewIndicators'])
        ->name('PendingReportViewIndicators');

    Route::get('PendingReportSelectReport/{Entity}/{ReportYear}',
        [ReviewReports::class, 'PendingReportSelectReport'])
        ->name('PendingReportSelectReport');

    Route::get('PendingReportSelectYear/{Entity}', [ReviewReports::class, 'PendingReportSelectYear'])
        ->name('PendingReportSelectYear');

    Route::get('Dashboard', [AppController::class, 'Dashboard'])
        ->name('Dashboard');

    Route::get('MgtEntities', [AppController::class, 'MgtEntities'])
        ->name('MgtEntities');

    Route::get('PendingReportEntities', [ReviewReports::class, 'PendingReportEntities'])
        ->name('PendingReportEntities');

    Route::any('/CF/{Entity}/{RID}', [AppController::class, 'CF'])
        ->name('CF');

    Route::any('/ReportCF/{Entity}/{RID}/{id}', [AppController::class, 'ReportCF'])
        ->name('ReportCF');

    Route::any('/ReportRRF/{Entity}/{RID}/{id}', [AppController::class, 'ReportRRF'])
        ->name('ReportRRF');

    Route::any('/RRF/{Entity}/{RID}', [AppController::class, 'RRF'])
        ->name('RRF');

    Route::any('/FileReport', [AppController::class, 'FileReport'])
        ->name('FileReport');

    Route::get('/IndicatorWarning', [AppController::class, 'IndicatorWarning'])
        ->name('IndicatorWarning');

    Route::get('/MgtIndicators', [AppController::class, 'MgtIndicators'])
        ->name('MgtIndicators');

    Route::any('ReportSelectEntity', [AppController::class, 'ReportSelectEntity'])
        ->name('ReportSelectEntity');

    Route::any('ReportSelectEntity', [AppController::class, 'ReportSelectEntity'])
        ->name('ReportSelectEntity');

    Route::any('ReportSelectReportingTimeFrame', [AppController::class,
        'ReportSelectReportingTimeFrame'])
        ->name('ReportSelectReportingTimeFrame');

    Route::get('/', [AppController::class, 'MgtIndicators'])->name('dashboard');

    Route::post('/CreateIndicator', [AppController::class, 'CreateIndicator'])
        ->name('CreateIndicator');

    Route::get('/MgtReportingTimelines', [AppController::class, 'MgtReportingTimelines'])
        ->name('MgtReportingTimelines');

    Route::get('/dashboard', [AppController::class, 'MgtIndicators']);

    Route::get('/SelectEntity', [AppController::class, 'SelectEntity'])->name('SelectEntity');

    Route::any('/SelectIndicatorCategory', [AppController::class, 'SelectIndicatorCategory'])
        ->name('SelectIndicatorCategory');

});

Route::middleware(['auth'])->group(function () {

    // CrudController Routes
    Route::get('MassDelete/{TableName}/{id}/{connection?}', [CrudController::class, 'MassDelete'])->name('MassDelete');
    Route::post('MassUpdate', [CrudController::class, 'MassUpdate'])->name('MassUpdate');
    Route::post('MassInsert', [CrudController::class, 'MassInsert'])->name('MassInsert');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
