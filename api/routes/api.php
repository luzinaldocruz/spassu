<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HealthCheckController;
use App\Http\Controllers\Api\LivroController;
use App\Http\Controllers\Api\AutorController;
use App\Http\Controllers\Api\AssuntoController;
use App\Http\Controllers\Api\RelatorioLivrosPorAutorController;

Route::get('/health', [HealthCheckController::class, 'check']);
Route::apiResource('livros', LivroController::class);
Route::apiResource('autores', AutorController::class);
Route::apiResource('assuntos', AssuntoController::class);
Route::get('relatorios/livros/autor/pdf', [RelatorioLivrosPorAutorController::class, 'gerarPdf']);
Route::get('relatorios/livros-por-autor', [RelatorioLivrosPorAutorController::class, 'index']);
