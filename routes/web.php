<?php

use App\Http\Controllers\FunctionsController;
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

Route::post('/', function () {
    return view('question1');
});


Route::get('/', [FunctionsController::class, 'index'])->name('question1');
Route::get('/question2',  [FunctionsController::class, 'index2'])->name('question2');
Route::get('/question3',  [FunctionsController::class, 'index3'])->name('question3');
Route::get('/question4',  function(){return view('question4');})->name('question4');
// Route::get('/question5',  function(){return view('question5');})->name('question5');

Route::get('/question5',  [FunctionsController::class, 'question5'])->name('question5');


Route::get('/checkDownload', [FunctionsController::class, 'checkDownload']);
Route::get('/analyzeMsg', [FunctionsController::class, 'analyzeMsg']);
Route::get('/testSummary', [FunctionsController::class, 'testSummary']);


Route::post('/checkDownload', [FunctionsController::class, 'checkDownload'])->name('checkDownload');
Route::post('/analyzeMsg', [FunctionsController::class, 'analyzeMsg'])->name('analyzeMsg');
Route::post('/testSummary', [FunctionsController::class, 'testSummary'])->name('testSummary');
