<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\Auth\AdminController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

Route::middleware(['auth', 'admin'])->group(function () {

    //Profile

    Route::get('/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/profile/update-password', [AdminController::class, 'updatePassword'])->name('admin.profile.updatePassword');
    Route::get('/admin/profile/edit-password', [AdminController::class, 'editPassword'])->name('admin.profile.editPassword');

    //Discount
    Route::resource('discounts', DiscountController::class);

    //Brand
    Route::resource('brands', BrandController::class);

    // Product Routes
    Route::get('product/list', [ProductController::class, 'listView'])->name('product.listView');
    Route::get('product/grid', [ProductController::class, 'gridView'])->name('product.gridView');
    Route::resource('products', ProductController::class)->except(['show']);
    
    // Fetch Brand Categories Route
    Route::get('/fetch-brand-categories/{brandId}', [ProductController::class, 'fetchBrandCategories']);
    
    // Profile
    Route::get('/profile', [AdminController::class, 'index'])->name('profile.index');

    
});

//Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        }
    );

    if ($status == Password::PASSWORD_RESET) {
        return redirect()->route('login')->with('status', 'Лозинката е успешно ресетирана. Ве молиме најавете се.');
    } else {
        return back()->withErrors(['email' => [__($status)]]);
    }
})->name('password.update');