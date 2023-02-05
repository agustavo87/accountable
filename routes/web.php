<?php

use App\Http\Livewire\Account\{
    Create as AccountCreate,
    Index as AccountIndex
};
use App\Http\Livewire\Operation\{
    Create as OperationCreate,
    Index as OperationIndex
};
use App\Http\Livewire\Category\Create as CategoryCreate;
use App\Http\Livewire\User\{
    Create as UserCreate,
    Login
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Route};

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


Route::get('/user/register', UserCreate::class)->name('user.register');;
Route::get('/user/login', Login::class)->name('user.login');
Route::get('/user/logout', function (Request $request) {

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');

})->name('user.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/account/create', AccountCreate::class)->name('account.create');
    Route::get('/account/index', AccountIndex::class)->name('account.index');
    Route::get('/operation/create', OperationCreate::class)->name('operation.create');
    Route::get('/operation/index', OperationIndex::class)->name('operation.index');
    Route::get('/category/create', CategoryCreate::class)->name('category.create');
});
