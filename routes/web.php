<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Agent\RegisteredAgentController;
use App\Http\Controllers\Agent\AuthenticatedAgentController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\SettingController as UserSettingController ;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\User\AgentController as UserAgentController;
use App\Http\Controllers\User\OrderController as UserOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//admin routes
Route::group(['as'=> 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']],function () {
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');

});


//user routes
Route::group(['as'=> 'user.', 'middleware' => ['auth', 'role:user']],function () {
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard');

    // category
    Route::resource('category', UserCategoryController::class);
    Route::put('category-status/{id}', [UserCategoryController::class,'changeStatus'])->name('category.status');


    // agent
    Route::resource('agents', UserAgentController::class,['only' => ['index', 'show']]);
    Route::put('agent-status/{id}', [UserAgentController::class,'changeStatus'])->name('category.status');

    // product
    Route::resource('product', UserProductController::class);
    Route::put('productImage_delete/{id}', [UserProductController::class,'productImage_delete'])->name('productImage_delete');

    Route::get('orders',[UserOrderController::class,'index'])->name('orders');
    Route::get('/orders/{id}/modal', [UserOrderController::class, 'getOrderModal']);
    Route::get('/order-shipping/{id}/modal', [UserOrderController::class, 'getOrderShipping']);
    Route::post('/order-shipping/{id}', [UserOrderController::class,'update']);


    Route::get('general-setting',[UserSettingController::class,'index'])->name('general-setting');
    Route::put('update-general-setting',[UserSettingController::class,'updateGeneralSetting'])->name('update-general-setting');

});

Route::get('/{slug}', [FrontController::class, 'home'])->name('store.show');
Route::resource('/{slug}/cart',CartController::class);
Route::get('/{slug}/order', [OrderController::class,'index'])->name('index_order');
Route::post('/{slug}/order/store', [OrderController::class,'store'])->name('store_order');
//user agent
Route::group(['as'=> 'agent.', 'prefix' => '{slug}', 'middleware' => 'guest'],function () {
    Route::get('register', [RegisteredAgentController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredAgentController::class, 'store']);

    Route::get('login', [AuthenticatedAgentController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedAgentController::class, 'store']);
});

Route::group(['as'=> 'agent.', 'prefix' => '{slug}', 'middleware' => ['auth', 'role:agent', 'CheckAgent']],function () {
    Route::get('/dashboard',[AgentController::class,'dashboard'])->name('dashboard');
    Route::post('logout', [AuthenticatedAgentController::class, 'destroy'])->name('logout');
});
