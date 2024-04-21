<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\backendController;
use App\Http\Controllers\usersController;

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

Route::get('/', [frontendController::class, 'home'])->name('front.home');
Route::get('/home', [frontendController::class, 'home'])->name('front.home');
Route::get('/about', [frontendController::class, 'about'])->name('front.about');
Route::get('/cancellation-refund-policy', [frontendController::class, 'cancellation'])->name('front.cancellation');
Route::get('/terms-of-service', [frontendController::class, 'termsofservice'])->name('front.terms');
Route::get('/privacy-policy', [frontendController::class, 'privacypolicy'])->name('front.privacy');
Route::get('/disclaimer', [frontendController::class, 'disclaimer'])->name('front.disclaimer');
Route::get('/faq', [frontendController::class, 'faq'])->name('front.faq');
Route::get('/search', [frontendController::class, 'search'])->name('front.search');
Route::get('/blog', [frontendController::class, 'blog'])->name('front.blog');
Route::get('/contact-us', [frontendController::class, 'contact'])->name('front.contact');
Route::post('/contact-us', [frontendController::class, 'sendcontact']);
Route::get('/blog/{slug}', [frontendController::class, 'singleblog'])->name('front.singleblog');
Route::get('/categories', [frontendController::class, 'blogcategories'])->name('front.categories');
Route::get('/categories/{slug}', [frontendController::class, 'singlecategories'])->name('front.singlecategories');
Route::get('/shop', [frontendController::class, 'shop'])->name('front.shop');
Route::get('/shop/{slug}', [frontendController::class, 'singleProduct'])->middleware('selectcolor');
Route::post('/shop/{slug}', [frontendController::class, 'singleAddProduct'])->middleware('selectcolor');
Route::get('/add-to-cart', [frontendController::class, 'addtocart']);
Route::get('/update-cart', [frontendController::class, 'Updateaddtocart']);
Route::delete('/add-to-cart/{id}', [frontendController::class, 'Deleteaddtocart']);
Route::get('/checkout', [frontendController::class, 'checkout']);


Route::get('/login',[usersController::class,'users'])->name('login.users');
Route::post('/checklogin',[usersController::class,'checklogin'])->name('checklogin.users');
Route::post('/login',[usersController::class, 'wpaddusers']);
Route::get('/logout',[usersController::class, 'logout'])->name('clogout');
Route::get('/dashboard',[usersController::class, 'dashboard'])->name('login.dashboard');
Route::get('/dashboard/{id}',[usersController::class, 'getorder']);
Route::delete('/dashboard/{id}',[usersController::class, 'deletegetorder']);
Route::post('/dashboard/userupdate',[usersController::class, 'userupdate']);
Route::post('/purchased',[usersController::class, 'purchased']);

Route::prefix('/admin')->group(function(){
  Route::get('/',[backendController::class, 'login']);
  Route::get('/dashboard',[backendController::class, 'dashboard'])->name('dashboard');
  Route::post('/login',[backendController::class, 'checklogin'])->name('login');
  Route::get('/logout',[backendController::class, 'logout'])->name('logout');

  Route::get('/all-blogs',[backendController::class, 'allblogs'])->name('all-blogs');
  Route::get('/add-blog',[backendController::class, 'addblog'])->name('add-blog');
  Route::post('/add-blog',[backendController::class, 'wpaddblog'])->name('wpadd-blog');
  Route::post('/update-blog',[backendController::class, 'UpdateBlog']);
  Route::get('/edit-blog/{id}',[backendController::class, 'editblog']);
  Route::delete('/delete-blog/{id}',[backendController::class, 'DeleteBlog']);

  Route::get('/all-contacts',[backendController::class, 'allContacts'])->name('all-contacts');
  Route::delete('/delete-contact/{id}',[backendController::class, 'DeleteContact']);

  Route::get('/all-blogs-categories',[backendController::class, 'allcategories'])->name('all-blogs-categories');
  Route::get('/add-blog-category',[backendController::class, 'addcategory'])->name('add-blog-category');
  Route::post('/add-blog-category',[backendController::class, 'wpaddcategory'])->name('wpadd-blog-category');
  Route::post('/update-blog-category',[backendController::class, 'UpdateBlogCategory']);
  Route::get('/edit-blog-categories/{id}',[backendController::class, 'editblogcategories']);
  Route::delete('/delete-blog-categories/{id}',[backendController::class, 'DeleteBlogCategory']);

  Route::get('/all-orders',[backendController::class, 'allorders'])->name('all-orders');
  Route::get('/all-orders/{id}',[backendController::class, 'singleorder']);
  Route::post('/all-orders/{id}',[backendController::class, 'updatesingleorder']);
  Route::delete('/delete-order/{id}',[backendController::class, 'Deleteorders']);

  Route::get('/all-customers',[backendController::class, 'allcustomers'])->name('all-customers');
  Route::delete('/delete-customers/{id}',[backendController::class, 'DeleteCustomer']);

  Route::get('/all-products',[backendController::class, 'allproducts'])->name('all-products');
  Route::get('/add-product',[backendController::class, 'addproduct'])->name('add-product');
  Route::post('/add-product',[backendController::class, 'wpaddproduct']);
  Route::post('/update-product',[backendController::class, 'Updateproduct']);
  Route::get('/edit-product/{id}',[backendController::class, 'editproduct']);
  Route::delete('/delete-product/{id}',[backendController::class, 'Deleteproduct']);

  Route::get('/all-products-categories',[backendController::class, 'allProductcategories'])->name('all-products-categories');
  Route::get('/add-product-category',[backendController::class, 'addProductcategory'])->name('add-product-category');
  Route::post('/add-product-category',[backendController::class, 'wpaddProductcategory']);
  Route::post('/update-product-category',[backendController::class, 'UpdateProductCategory']);
  Route::get('/edit-product-categories/{id}',[backendController::class, 'editProductcategories']);
  Route::delete('/delete-product-categories/{id}',[backendController::class, 'DeleteProductCategory']);

  Route::get('/post-seo/{id}',[backendController::class, 'postseo'])->name('postseo');
  Route::post('/post-seo',[backendController::class, 'wpaddpostseo']);
  
  Route::get('/post-cat-seo/{id}',[backendController::class, 'postcatseo'])->name('postcatseo');
  Route::post('/post-cat-seo',[backendController::class, 'wpaddpostcatseo']); 

  Route::get('/global-seo',[backendController::class, 'globalseo'])->name('global-seo'); 
  Route::post('/global-seo',[backendController::class, 'wpglobalseo'])->name('wp-global-seo'); 

  Route::get('/admin-info',[backendController::class, 'admininfo'])->name('admin-info'); 
  Route::post('/admin-info',[backendController::class, 'wpadmininfo'])->name('wp-admin-info'); 

  Route::get('/page-seo',[backendController::class, 'pageseo'])->name('page-seo'); 
  Route::get('/add-page',[backendController::class, 'getpage'])->name('add-page'); 
  Route::post('/add-page',[backendController::class, 'addpage']); 
  Route::get('/edit-page/{id}',[backendController::class, 'geteditpage']); 
  Route::post('/update-page',[backendController::class, 'updatepageseo']); 
  Route::get('/delete-page/{id}',[backendController::class, 'deletepageseo']); 
});

Route::get('/{slug}',[frontendController::class, 'redirectpage'])->name('front.redirectpage');

Route::fallback(function () {
  return view('404');
});