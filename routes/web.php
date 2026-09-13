<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::resource('boards', BoardController::class)->except('show');
Route::resource('projects', ProjectController::class)->except('show');
Route::get('projects/{project}/boards/search', [ProjectController::class, 'searchBoards'])->name('projects.boards.search');
Route::post('projects/{project}/boards/{board}', [ProjectController::class, 'attachBoard'])->name('projects.boards.attach');
Route::delete('projects/{project}/boards/{board}', [ProjectController::class, 'detachBoard'])->name('projects.boards.detach');

Route::prefix('core')->group(function () {
    Route::prefix('inc')->group(function () {
        Route::get('main', function () { return view('core.inc.main');});
        Route::get('stm32f1xx_hal_conf', function () { return view('core.inc.stm32f1xx_hal_conf');});
        Route::get('stm32f1xx_it', function () { return view('core.inc.stm32f1xx_it'); });
    });
    Route::prefix('src')->group(function () {
        Route::get('main', function () { return view('core.src.main');});
        Route::get('stm32f1xx_hal_msp', function () { return view('core.src.stm32f1xx_hal_msp');});
        Route::get('stm32f1xx_it', function () { return view('core.src.stm32f1xx_it'); });
    });
});