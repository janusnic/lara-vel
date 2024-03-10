<?php

use Illuminate\Support\Facades\Route;


use App\Livewire\Main\{HomePage, BlogPage, Catalog, ShoppingCart};

Route::get('/', HomePage::class)->name('home');

Route::get('shop', Catalog::class)->name('shop');
Route::get('shopping-cart', ShoppingCart::class)->name('shopping.cart');


use App\Http\Controllers\PostController;

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');


use App\Http\Controllers\Admin\{DashboardController, BrandController};

use App\Livewire\Admin\Products\{ProductList, CreateProduct, UpdateProduct};

use App\Livewire\Admin\Posts\{PostList, CreatePost, UpdatePost};
use App\Livewire\Admin\Tags\{TagList, CreateTag, EditTag};
use App\Livewire\Admin\Roles\{RoleList, CreateRole, EditRole};
use App\Livewire\Admin\Users\{UsersList, CreateUser, EditUser};

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/order', [App\Http\Controllers\OrderController::class, 'placeOrder'])->name('checkout.place.order');

    Route::name('admin.')->prefix('admin')->group(function () {
        
        
        Route::get('', function () {
            return view('admin.index');
        });
        Route::resource('brands', BrandController::class);
        
        Route::get('products', ProductList::class)->name('products.index');
        Route::get('products/create', CreateProduct::class)->name('products.create');
        Route::get('products/{product}/edit', UpdateProduct::class)->name('products.edit');

        Route::get('posts', PostList::class)->name('posts.index');
        Route::get('posts/create', CreatePost::class)->name('posts.create');
        Route::get('posts/{post}/edit', UpdatePost::class)->name('posts.edit');
        
        Route::get('tags', TagList::class);
        Route::get('tags/{tag}/edit', EditTag::class)->name('tags.edit');
        // 
        Route::get('roles', RoleList::class)->name('roles.index');
        Route::get('roles/create', CreateRole::class)->name('roles.create');
        Route::get('roles/{role}/edit', EditRole::class)->name('roles.edit');

        Route::get('users', UsersList::class)->name('users.index');
        Route::get('users/create', CreateUser::class)->name('users.create');
        Route::get('users/{user}/edit', EditUser::class)->name('users.edit');
    });
});
