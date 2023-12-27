<?php

use App\Http\Controllers\API\Controller_Auth;
use App\Http\Controllers\API\Controller_Database;
use App\Http\Controllers\API\Controller_InputData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [Controller_Auth::class, 'register']);
Route::post('/login', [Controller_Auth::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [Controller_Auth::class, 'logout']);

    // ADMIN ACTIVITY
    Route::get('/getAllData', [Controller_Database::class, 'getAllData']);
    Route::get('/getData/{nidn_dosen}', [Controller_Database::class, 'getData']);
    Route::delete('/hapusData/{nidn_dosen}', [Controller_Database::class, 'hapusData']);
    Route::post('/inputNIDN', [Controller_Database::class, 'inputNIDN']);


    // USER ACTIVITY
    Route::post('/updateDataDiri/{nidn_dosen}', [Controller_Database::class, 'updateDataDiri']);
    Route::post('/updateDataPendidikan/{nidn_dosen}', [Controller_Database::class, 'updateDataPendidikan']);
    Route::post('/updateDataProdi/{nidn_dosen}', [Controller_Database::class, 'updateDataProdi']);
    Route::post('/updateDataJabatan/{nidn_dosen}', [Controller_Database::class, 'updateDataJabatan']);
    Route::post('/updateDataPengembangan/{nidn_dosen}', [Controller_Database::class, 'updateDataPengembangan']);
    Route::post('/updateDataStaff/{nidn_dosen}', [Controller_Database::class, 'updateDataStaff']);
    Route::post('/inputDataDiri', [Controller_Database::class, 'inputDataDiri']);
    Route::post('/inputDataPendidikan', [Controller_Database::class, 'inputDataPendidikan']);
    Route::post('/inputDataProdi', [Controller_Database::class, 'inputDataProdi']);
    Route::post('/inputDataJabatan', [Controller_Database::class, 'inputDataJabatan']);
    Route::post('/inputDataPengembangan', [Controller_Database::class, 'inputDataPengembangan']);
    Route::post('/inputDataStaff', [Controller_Database::class, 'inputDataStaff']);
    Route::get('/getDataDosen', [Controller_Database::class, 'getDataDosen']);
    Route::get('/getDataPendidikan', [Controller_Database::class, 'getDataPendidikan']);
    Route::get('/getDataProdi', [Controller_Database::class, 'getDataProdi']);
    Route::get('/getDataJabatan', [Controller_Database::class, 'getDataJabatan']);
    Route::get('/getDataPengembanganDiri', [Controller_Database::class, 'getDataPengembanganDiri']);
    Route::get('/getDataStaff', [Controller_Database::class, 'getDataStaff']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
