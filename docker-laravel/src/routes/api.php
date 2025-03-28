<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectibleController;
use App\Http\Controllers\ExplorerController;

Route::resource('/exploradores', ExplorerController::class) ;

Route::post('/inventario/troca', [CollectibleController::class, 'trade']);

Route::get('/relatorios', [CollectibleController::class, 'report']);

Route::get('/exploradores/{id}/historico', [ExplorerController::class, 'history']);

Route::resource('/inventario', CollectibleController::class);

