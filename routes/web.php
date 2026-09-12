<?php

use Illuminate\Support\Facades\Route;

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