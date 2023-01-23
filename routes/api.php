<?php

use App\Http\Controllers\CollaboratorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('collaborators', [CollaboratorsController::class, "getAll"]);

Route::get('collaborators/{id}', [CollaboratorsController::class, "getById"]);

Route::post('collaborators/new', [CollaboratorsController::class, "newCollaborator"]);

Route::put('collaborators/edit/{id}', [CollaboratorsController::class, "editCollaborator"]);

Route::delete('collaborators/delete/{id}', [CollaboratorsController::class, "deleteCollaborator"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});