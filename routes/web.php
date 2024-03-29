<?php

use App\Http\Controllers\Logout;
use App\Http\Controllers\TestViewController;
use App\Http\Livewire\Account\{
    Create as AccountCreate,
    Index as AccountIndex
};
use App\Http\Livewire\Operation\{
    Create as OperationCreate,
    Index as OperationIndex
};
use App\Http\Livewire\Category\Create as CategoryCreate;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Settings;
use App\Http\Livewire\User\{
    Create as UserCreate,
    Login
};
use App\Models\CryptoCurrency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\Feature\IsoTest;

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

Route::middleware('guest')->group(function () {
    Route::get('/user/register', UserCreate::class)->name('user.register');;
    Route::get('/user/login', Login::class)->name('user.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/logout', Logout::class)->name('user.logout');
    Route::get('/', function () {
        return redirect()->route('home');
    })->name('landing');
    Route::get('/home', Dashboard::class)->name('home');
    Route::get('/account/create', AccountCreate::class)->name('account.create');
    Route::get('/account/index', AccountIndex::class)->name('account.index');
    Route::get('/operation/create', OperationCreate::class)->name('operation.create');
    Route::get('/category/create', CategoryCreate::class)->name('category.create');
    Route::get('/settings', Settings::class)->name('settings');
});

Route::get('/codes', function() {
    (new IsoTest())->test_countries_hydration();
});

Route::middleware('env:local')->group(function () {
    Route::get('test/view/{view}', TestViewController::class);
});

Route::get('currencies', function () {
    return response()->json(CryptoCurrency::all());
});