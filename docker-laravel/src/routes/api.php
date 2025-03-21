<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectibleController;
use App\Http\Controllers\ExplorerController;

Route::resource('/exploradores', ExplorerController::class);

Route::resource('/inventario', CollectibleController::class);

Route::post('/inventario/troca', [CollectibleController::class, 'trade']);