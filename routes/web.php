<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\MicroController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::resource('board', BoardController::class)->except('show');
Route::resource('micro', MicroController::class)->except('show');
Route::resource('project', ProjectController::class)->except('show');
Route::get('project/{project}/board/search', [ProjectController::class, 'searchBoards'])->name('project.board.search');
Route::post('project/{project}/board/{board}', [ProjectController::class, 'attachBoard'])->name('project.board.attach');
Route::delete('project/{project}/board/{board}', [ProjectController::class, 'detachBoard'])->name('project.board.detach');

Route::prefix('programing')->group(function () {
    Route::get('bluepill', function () { return view('programing.bluepill');});
});
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
