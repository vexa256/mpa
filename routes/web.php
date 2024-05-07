<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ProfileController;
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
