<?php

use App\Events\test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VoitureController;
use App\Models\Contrats;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


//Client route
Route::get('/api/clients' , [ClientsController::class ,"index"]);
Route::post("/api/clients/add" , [ClientsController::class , "create"]);
Route::delete("/api/client/delete/{id}" , [ClientsController::class , 'delete']);
Route::get('/api/client/{id}' , [ClientsController::class , "getClient"]);
Route::post('/api/client/edit/{id}' , [ClientsController::class , "edit"]);

//Voiture route
Route::get('/api/voitures' , [VoitureController::class , 'index']);
Route::post('/api/voitures/add' , [VoitureController::class , 'create']);
Route::delete('/api/voitures/delete/{id}' , [VoitureController::class , 'delete']);
Route::get('/api/voitures/{id}' , [VoitureController::class , 'getVoiture']);
Route::post('/api/voitures/edit/{id}' , [VoitureController::class , 'edit']);

//contrat route
Route::get('/api/contrats' , [ContratController::class , 'index']);
Route::post("/api/contrat/add" , [ContratController::class , "create"]);
Route::post("/api/contrat/cars" , [ContratController::class , "getVoituresDispo"]);
Route::delete('/api/contrat/delete/{id}' , [ContratController::class , 'delete']);
Route::get('/api/contrats/getNombre' , [ContratController::class , 'getNombreContrats']);

//notification routes
Route::get('/api/notification' , [NotificationController::class , 'index']);
Route::get('/api/notification/notOpen/{user_id}' , [NotificationController::class ,"getNotificationNotopen"]);


//role routes
Route::get('/api/roles' , [RoleController::class , 'index']);
Route::post('/api/roles/addrole' , [RoleController::class , 'create']);
Route::delete('/api/role/delete/{id}' , [RoleController::class , 'delete']);


Route::get('/uploads/{filename}', function ($filename) {
    $path = public_path('uploads/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    abort(404);
});





require __DIR__.'/auth.php';
