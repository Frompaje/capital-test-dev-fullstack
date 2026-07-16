<?php

use App\Http\Controllers\EnterpriseController;
use Illuminate\Support\Facades\Route;

Route::apiResource('enterprises', EnterpriseController::class);
