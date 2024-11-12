<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::post('/receive-applicant', [DataController::class, 'receive']);



Route::post('/data/receive', [DataController::class, 'receive'])
    ->name('api.data.receive');