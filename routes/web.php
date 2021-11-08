<?php

use App\Http\Controllers\PositionBoxController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Vehicle Module
|--------------------------------------------------------------------------
*/
Route::get('positionbox', [App\Http\Controllers\PositionBoxController::class, 'index'])->name('positionbox.index');
Route::group(['prefix' => 'positionbox', 'middleware' => 'auth'], function () {
    Route::get('{position_box}/manage', [App\Http\Controllers\PositionBoxController::class, 'edit'])->name('positionbox.manage');
    Route::get('{position_box}/{position_box_content}/manage', [App\Http\Controllers\PositionBoxController::class, 'editContent'])->name('positionbox.manage.content');
    Route::post('{position_box}/update', [App\Http\Controllers\PositionBoxController::class, 'update'])->name('positionbox.update');
    Route::post('{position_box}/{position_box_content}/update', [App\Http\Controllers\PositionBoxController::class, 'updateContent'])->name('positionbox.update.content');
    Route::post('{position_box}/delete', [App\Http\Controllers\PositionBoxController::class, 'destroy'])->name('positionbox.delete');
    Route::post('{position_box}/{position_box_content}/delete', [App\Http\Controllers\PositionBoxController::class, 'destroyContent'])->name('positionbox.delete.content');
    Route::get('{position_box}/add-content', [App\Http\Controllers\PositionBoxController::class, 'addNewContent'])->name('positionbox.content.add');
    Route::post('{position_box}/create', [App\Http\Controllers\PositionBoxController::class, 'storeContent'])->name('positionbox.store.content');
});

require __DIR__ . '/auth.php';
