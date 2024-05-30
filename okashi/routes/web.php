<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\PurchaseLinesController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ShoppingCartsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MfaController;
use App\Http\Controllers\CardController;

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

// General Pages
Route::get('/', [IndexController::class, 'showIndex'])->name('index.show');
Route::view('/about', 'about');
Route::post('/about', [IndexController::class, 'aboutContact']);
Route::view('/contact', 'contact');

// Product Pages
Route::get('/products', [ProductsController::class, 'showListProducts'])->name('productsList.show');
Route::get('/product/{id}', [ProductsController::class, 'showProductDetails'])->name('productDetails.show');
Route::post('/product/{id}', [ProductsController::class, 'buyProduct']);
Route::get('/search', [ProductsController::class, 'searchProduct']);

// Authentication Routes
Auth::routes(['verify' => true]);
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register/verify/{code}', [GuestController::class, 'verify']);

// MFA Routes
Route::middleware('auth')->group(function () {
    Route::get('/mfa', [MfaController::class, 'showMfaForm'])->name('mfa.show');
    Route::post('/mfa/send', [MfaController::class, 'sendMfaCode'])->name('mfa.send');
    Route::post('/mfa/verify', [MfaController::class, 'verifyMfaCode'])->name('mfa.verify');
});

// Routes requiring authentication and 2FA
Route::middleware(['auth', '2fa'])->group(function () {
    // Profile Routes
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit/{id}', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/enable-mfa', [ProfileController::class, 'enableMfa'])->name('profile.enable-mfa');
    Route::post('/profile/disable-mfa', [ProfileController::class, 'disableMfa'])->name('profile.disable-mfa');

    // Shopping Cart Routes
    Route::get('/shoppingCart', [ShoppingCartsController::class, 'showCurrentCart'])->name('shoppingCart.show');
    Route::post('/shoppingCart/add', [ShoppingCartsController::class, 'addProductToCart'])->name('shoppingCart.add');
    Route::post('/shoppingCart/{id}/modify', [ShoppingCartsController::class, 'modifyProductQuantity'])->name('shoppingCart.modify');
    Route::delete('/shoppingCart/{id}', [ShoppingCartsController::class, 'deleteShoppingCart'])->name('ShoppingCart.delete');
    Route::post('/shoppingCart/{id}/buy', [ShoppingCartsController::class, 'buyCart'])->name('buyCart');
    Route::delete('/shoppingCart/{id}/delete', [ShoppingCartsController::class, 'deleteProduct'])->name('deleteProduct');

    // Card Routes
    Route::get('/createCard', [CardController::class, 'create'])->name('Card.create');
    Route::post('/admin/store/Card', [CardController::class, 'store'])->name('Card.store');
    Route::post('/processPayment', [CardController::class, 'processPayment'])->name('processPayment');
    Route::get('/admin/Card/{id}/modify', [CardController::class, 'showModifyCard'])->name('Card.modify');
    Route::delete('/admin/Card/{id}/delete', [CardController::class, 'deleteCard'])->name('Card.delete');
    Route::get('/checkout', [CardController::class, 'showCheckout'])->name('checkout');

    // Purchase Routes
    Route::post('/purchase', [PurchasesController::class, 'createPurchase'])->name('purchase.create');
    Route::get('/purchaseHistory/{id}', [PurchasesController::class, 'showPurchaseHistory'])->name('purchaseHistory.show');
});

// Admin Routes
Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'showAdmin'])->name('admin.show');
    Route::get('/admin/{func}', [AdminController::class, 'listDB']);
    Route::get('/admin/create/Address', [AddressesController::class, 'showCreateAddressForm'])->name('admin.address.create');
    Route::post('/admin/create/Address', [AddressesController::class, 'createAddress'])->name('admin.address.add');
    Route::post('/user/create/Address', [UsersController::class, 'addAddressByUser'])->name('user.address.add');
    
    // CRUD Routes for Admin
    Route::get('/admin/create/Product', function () {
        return view('createProduct');
    });
    Route::post('/admin/create/Product', [ProductsController::class, 'createProduct']);
    Route::get('/admin/create/User', function () {
        return view('createUser');
    });
    Route::post('/admin/create/User', [UsersController::class, 'createUser']);
    Route::delete('/products/{id}', [ProductsController::class, 'deleteProduct'])->name('Product.delete');
    Route::delete('/users/{id}', [UsersController::class, 'deleteUser'])->name('User.delete');
    Route::delete('/addresses/{id}', [AddressesController::class, 'deleteAddress'])->name('Address.delete');
    Route::delete('/purchases/{id}', [PurchasesController::class, 'deletePurchase'])->name('Purchase.delete');
    Route::delete('/purchasesLines/{id}', [PurchaseLinesController::class, 'deletePurchaseLine'])->name('PurchaseLine.delete');
    Route::get('/products/{id}/modify', [ProductsController::class, 'showModifyProduct'])->name('Product.modify');
    Route::put('/products/{id}', [ProductsController::class, 'modifyProduct']);
    Route::get('/users/{id}/modify', [UsersController::class, 'showModifyUser'])->name('User.modify');
    Route::put('/users/{id}', [UsersController::class, 'modifyUser']);
    Route::get('/addresses/{id}/modify', [AddressesController::class, 'showModifyAddress'])->name('Address.modify');
    Route::put('/addresses/{id}', [AddressesController::class, 'modifyAddress']);
    Route::get('/shoppingCarts/{id}/modify', [ShoppingCartsController::class, 'showModifyShoppingCart'])->name('ShoppingCart.modify');
    Route::put('/shoppingCarts/{id}', [ShoppingCartsController::class, 'modifyShoppingCart']);
    Route::get('/purchases/{id}/modify', [PurchasesController::class, 'showmodifyPurchase'])->name('Purchase.modify');
    Route::put('/purchases/{id}', [PurchasesController::class, 'modifyPurchase']);
    Route::get('/purchasesLines/{id}/modify', [PurchaseLinesController::class, 'showmodifyPurchaseLine'])->name('PurchaseLine.modify');
    Route::put('/purchasesLines/{id}', [PurchaseLinesController::class, 'modifyPurchaseLine']);
});

// Language Routes
Route::get('language/{locale}', [LanguageController::class, 'change'])->name('language.change');
