<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentAuthController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ReinscriptionController;
use App\Http\Controllers\ClassController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/parents/register', [ParentAuthController::class, 'register']);
Route::post('/parents/login', [ParentAuthController::class, 'login']);
Route::get('/parents/confirm/{token}', [ParentAuthController::class, 'confirm']);


Route::post('/inscriptions', [InscriptionController::class, 'store'])->middleware('auth:sanctum'); // Créer une inscription
Route::get('/inscriptions', [InscriptionController::class, 'list'])->middleware('auth:sanctum');// Lister les inscriptions
Route::post('/reinscription', [ReinscriptionController::class, 'reinscrire'])->middleware('auth:sanctum');
Route::get('/main-classes', [ClassController::class, 'getClasses']);