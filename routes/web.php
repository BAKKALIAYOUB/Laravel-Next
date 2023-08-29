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

//notification routes
Route::get('/api/notification' , [NotificationController::class , 'index']);


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




Route::get('/test' , function(){
    $now = Carbon::now()->format("Y-m-d");
    $contrat_user = Contrats::whereDate("date_fin" , $now)->get();
    $users = User::all();


    $notification_ws = array();

    foreach($contrat_user as $c){
        foreach($users as $user){
            if($user->id == $c->id_user){
                $notification = new Notification();

                $notification->id_user = $user->id;
                $notification->id_contrat = $c->id;

                $notification->description = "Contrat de " .$c->client->fullname." expiré le ".$c->date_fin;
                $notification->save();
                array_push($notification_ws , $notification);
            }
        }
    }

});
require __DIR__.'/auth.php';
