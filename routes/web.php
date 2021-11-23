<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get("/azure", [TestController::class, "azure"]);
Route::post("/upload", [TestController::class, "upload"])->name('upload');
Route::get('files-from-azure', [TestController::class, "filesFromAzure"]);
Route::get('/preview', [TestController::class, 'previewFile']);