<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\oldLoginController;
use App\Http\Controllers\Admin\Dashboardcontroller;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\OrderProcessController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\Cartcontroller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\UserQuestionController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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
//login ,register and logout

Auth::routes();
//user regsitration
Route::get('user/register', [RegisterController::class, 'register'])->name('user.register');
Route::post('user/register/store', [RegisterController::class, 'registerStore'])->name('user.register.store');
Route::get('user/verify', [RegisterController::class, 'verify'])->name('user.verify');
Route::post('user/verify/store', [RegisterController::class, 'verify'])->name('user.verify.store');
Route::put('user-info-update/{id}', [MyAccountController::class, 'infoUpdate'])->name('user.info.update');
Route::get('user-info-destroy/{id}', [MyAccountController::class, 'infoDestroy'])->name('user.info.destroy');


Route::get('/',[Homecontroller::class, 'index'])->name('welcome');
Route::post('/item-search',[Homecontroller::class, 'search'])->name('item.search');
Route::get('/all/item/show',[Homecontroller::class, 'allItemShow'])->name('all.item.show');
Route::get('/category/item/show/{id}',[Homecontroller::class, 'CategoryItemShow'])->name('category.item.show');
Route::get('/top-selling/item',[Homecontroller::class, 'topItemSelling'])->name('top.selling.item');
Route::get('/category-item/{id}',[Homecontroller::class, 'CategoryItem'])->name('category.item');
// item show
Route::get('/item/{id}',[Homecontroller::class, 'show'])->name('items.show');
// routes for rating
Route::get('/rating',[Homecontroller::class, 'rating'])->name('rating');
Route::post('/rating/store',[Homecontroller::class, 'store'])->name('rating.store');
// product question routes
Route::post('/question/store', [QuestionController::class, 'questionStore'])->name('question.store');

Route::post('/item/store/cart',[Cartcontroller::class, 'storeCart'])->name('item.store.cart');
Route::get('/cart/item/increment/{id}',[Cartcontroller::class, 'increment']);
Route::get('/cart/item/decrement/{id}',[Cartcontroller::class, 'decrement']);
Route::get('/cart/item/destroy/{id}',[Cartcontroller::class, 'destroy'])->name('cart.item.destroy');
Route::get('/checkout',[CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/orders/store',[OrderController::class, 'store'])->name('orders.store');
Route::put('/orders/update/{id}',[OrderController::class, 'update'])->name('orders.update');
Route::get('/orders/history',[OrderController::class, 'index'])->name('orders.history');
Route::get('/orders/history/show/{id}',[OrderController::class, 'show'])->name('order.history.show');
// contact
Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::post('/contact/send',[ContactController::class,'sendMessage'])->name('contact.send');

// about
Route::get('/about',[AboutController::class,'index'])->name('about');

// my account controller
Route::get('/my-account/{id}',[MyAccountController::class,'index'])->name('my.account');






// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//All admins route here

Route::group(['prefix' =>'admin', 'middleware' =>'auth'], function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('users-profile',[UserProfileController::class,'index'])->name('admin.users.profile');
    Route::get('users-profile/delete/{id}',[UserProfileController::class,'destory'])->name('admin.users.profile.destory');
    Route::resource('slider', SliderController::class);
        Route::resource('category', CategoryController::class);
    Route::resource('item', ItemController::class);
//   user ratings
    Route::get('user/ratings', [RatingController::class, 'userRating'])->name('user.rating');
    Route::get('user/ratings/show/{id}', [RatingController::class, 'show'])->name('user.rating.show');
    Route::get('user/ratings/destroy/{id}', [RatingController::class, 'destroy'])->name('user.rating.destroy');
//  user question routes
    Route::get('user/questions', [UserQuestionController::class, 'index'])->name('user.questions');
    Route::get('user/question/show/{id}', [UserQuestionController::class, 'show'])->name('user.question.show');
    Route::post('answer', [UserQuestionController::class, 'answer'])->name('admin.answer');
    Route::get('answer/destory/{id}', [UserQuestionController::class, 'answerDestory'])->name('admin.answer.destory');
    Route::get('user/question/destory/{id}', [UserQuestionController::class, 'destory'])->name('user.questions.destory');

//   user order process
    Route::get('order/process', [OrderProcessController::class, 'index'])->name('user.order.process.index');
    Route::get('order/process/status/{id}', [OrderProcessController::class, 'statusChange'])->name('order.process.status');
    Route::get('order/process/info/show/{id}', [OrderProcessController::class, 'info'])->name('order.process.info.show');
    Route::get('order/process/destroy/{id}', [OrderProcessController::class, 'destroy'])->name('order.process.destroy');



    Route::get('contact',[App\Http\Controllers\Admin\ContactController::class,'index'])->name('contact.index');
    Route::get('contact/{id}',[App\Http\Controllers\Admin\ContactController::class,'show'])->name('contact.show');
    Route::delete('contact/{id}',[App\Http\Controllers\Admin\ContactController::class,'destroy'])->name('contact.destroy');
});
