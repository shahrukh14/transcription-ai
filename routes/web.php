<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProofReaderController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Auth\UserLogincontroller;
use App\Http\Controllers\GeneralsettingsController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleAndPermissionController;





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


Route::get('test/api', [TestController::class, 'testApi'])->name('test.api');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('login-details-submit', [AdminLoginController::class, 'loginDetailsSubmit'])->name('login-details-submit');
    Route::get('forgot-password', [AdminLoginController::class, 'forgotPasswordForm'])->name('forgot.password');
    Route::post('send-otp', [AdminLoginController::class, 'sendOtp'])->name('send.otp');
    Route::post('otp-verification', [AdminLoginController::class, 'otpVerification'])->name('otp.verification');
    Route::get('reset-password', [AdminLoginController::class, 'resetPasswordform'])->name('reset.password');
    Route::post('reset-password', [AdminLoginController::class, 'resetPassword'])->name('reset.password');


    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('profileform', [AdminController::class, 'profileForm'])->name('profileForm');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::post('update-profile/{id}', [AdminController::class, 'updateProfile'])->name('updateProfile');
        Route::get('user-list', [AdminController::class, 'userList'])->name('user-list');
        Route::get('add-user-form', [AdminController::class, 'addUserForm'])->name('add-user-form');
        Route::post('change-user-status', [AdminController::class, 'changeUserStatus'])->name('change-user-status');
        Route::post('add-user', [AdminController::class, 'addUser'])->name('add-user');
        Route::get('edit-user/{id}', [AdminController::class, 'editUser'])->name('edit-user');
        Route::post('update-user/{id}', [AdminController::class, 'updateUser'])->name('update-user');
        Route::get('change-user-password/{id}', [AdminController::class, 'changeUserPassword'])->name('change-user-password');
        Route::get('delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
        Route::get('add-permission-form', [RoleAndPermissionController::class, 'addPermissionForm'])->name('add-permission-form');
        Route::post('add-permission', [RoleAndPermissionController::class, 'addPermission'])->name('add-permission');
        Route::get('roles', [RoleAndPermissionController::class, 'roleList'])->name('roles');
        Route::get('add-role-form', [RoleAndPermissionController::class, 'addRoleForm'])->name('add-role-form');
        Route::post('add-role', [RoleAndPermissionController::class, 'addRole'])->name('add-role');
        Route::post('change-role-status', [RoleAndPermissionController::class, 'changeRoleStatus'])->name('change-role-status');

        //Faq
        Route::get('faq-list', [FaqController::class, 'faqList'])->name('faq.list');
        Route::get('faq-form', [FaqController::class, 'faqcreate'])->name('faq.form');
        Route::post('faq-add', [FaqController::class, 'faqadd'])->name('faq.add');
        Route::get('faq-edit/{id}', [FaqController::class, 'faqedit'])->name('faq.edit');
        Route::post('faq-update/{id}', [FaqController::class, 'faqupdate'])->name('faq.update');
        Route::get('faq-delete/{id}', [FaqController::class, 'faqdelete'])->name('faq.delete');
        //Blog
        Route::get('blog-list', [BlogController::class, 'index'])->name('blog.list');
        Route::get('blog-form', [BlogController::class, 'create'])->name('blog.form');
        Route::post('blog-form', [BlogController::class, 'store']);
        Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('blog/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::get('blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

        //testimonial   
        Route::get('testimonial-list', [TestimonialController::class, 'testimoniallisting'])->name('testimonial.list');
        Route::get('testimonial-form', [TestimonialController::class, 'testimonialcreate'])->name('testimonial.form');
        Route::post('testimonial-form', [TestimonialController::class, 'testimonialstore']);
        Route::get('testimonial/edit/{id}', [TestimonialController::class, 'testimonialedit'])->name('testimonial.edit');
        Route::put('testimonial/{id}', [TestimonialController::class, 'testimonialupdate'])->name('testimonial.update');
        Route::get('testimonial/{id}', [TestimonialController::class, 'testimonialdelete'])->name('testimonial.destroy');

        // dynamic
        Route::get('dynamic-list', [DynamicController::class, 'DynamicList'])->name('dynamic.list');
        Route::get('dynamic-add-form', [DynamicController::class, 'DynamicForm'])->name('dynamic.add.form');
        Route::post('dynamic-add', [DynamicController::class, 'DynamicAdd'])->name('dynamic.add');
        Route::get('dynamic-edit/{id}', [DynamicController::class, 'DynamicEdit'])->name('dynamic.edit');
        Route::put('dynamic-update/{id}', [DynamicController::class, 'DynamicUpdate'])->name('dynamic.update');
        Route::get('dynamic-delete/{id}', [DynamicController::class, 'DynamicDelete'])->name('dynamic.delete');

        //gallery
        Route::get('gallery-list', [GalleryController::class, 'galleryllisting'])->name('gallery.list');
        Route::get('gallery-add-form', [GalleryController::class, 'galleryForm'])->name('gallery.add.form');
        Route::post('gallery-add', [GalleryController::class, 'galleryAdd'])->name('gallery.add');
        Route::get('gallery-edit/{id}', [GalleryController::class, 'galleryEdit'])->name('gallery.edit');
        Route::put('gallery-update/{id}', [GalleryController::class, 'galleryUpdate'])->name('gallery.update');
        Route::get('gallery-delete/{id}', [GalleryController::class, 'galleryDelete'])->name('gallery.delete');

        //add photo
        Route::get('photo/{id}', [PhotoController::class, 'photo'])->name('photo');
        Route::post('photo/add/{id}', [PhotoController::class, 'photoAdd'])->name('photo.add');
        Route::get('delete/{id}', [PhotoController::class, 'PhotoDelete'])->name('photo.delete');
         
        // banner image
        Route::get('banner', [WebsiteController::class, 'banner'])->name('banner');
        Route::post('update-banner/{id}', [WebsiteController::class, 'updateBanner'])->name('update.banner');
        Route::post('update/user-banner', [WebsiteController::class, 'updateUserBanner'])->name('update.user.banner');
        Route::get('delete-banner/{image}', [WebsiteController::class, 'deleteBanner'])->name('delete.banner');
        Route::get('delete-user-banner/{image}', [WebsiteController::class, 'deleteUserBanner'])->name('delete.user.banner');

        // General Settings Routes
        Route::get('general-settings', [GeneralsettingsController::class, 'generalsettingscreate'])->name('general.settings');
        Route::post('generalsettings_form', [GeneralsettingsController::class, 'generalsettingsstore'])->name('general.setting.update');

        Route::get('assign-permissions-to-role/{role_name}', [RoleAndPermissionController::class, 'assignPermissionForm'])->name('assign-permissions-to-role');
        Route::post('assign-permissions', [RoleAndPermissionController::class, 'assignPermissions'])->name('assign-permissions');

        //Customers
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [CustomerController::class, 'list'])->name('list');
            Route::get('add', [CustomerController::class, 'add'])->name('add');
            Route::post('insert', [CustomerController::class, 'insert'])->name('insert');
            Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [CustomerController::class, 'update'])->name('update');
            Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('delete');
        });

        //Proof Reader
         Route::prefix('proof-reader')->name('proof-reader.')->group(function () {
            Route::get('/', [ProofReaderController::class, 'list'])->name('list');
            Route::get('add', [ProofReaderController::class, 'add'])->name('add');
            Route::post('insert', [ProofReaderController::class, 'insert'])->name('insert');
            Route::get('edit/{id}', [ProofReaderController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ProofReaderController::class, 'update'])->name('update');
            Route::get('delete/{id}', [ProofReaderController::class, 'delete'])->name('delete');
        });

        //Packages
        Route::prefix('package')->name('package.')->group(function () {
            Route::get('/', [PackagesController::class, 'list'])->name('list');
            Route::get('add', [PackagesController::class, 'add'])->name('add');
            Route::post('insert', [PackagesController::class, 'insert'])->name('insert');
            Route::get('edit/{id}', [PackagesController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [PackagesController::class, 'update'])->name('update');
            Route::get('delete/{id}', [PackagesController::class, 'delete'])->name('delete');
        });

        //Spatie Protected Routes
        Route::middleware(['permission'])->group(function () {
        });
    });
});


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('blog', [HomeController::class, 'blog'])->name('blog');
Route::get('blog-details', [HomeController::class, 'blogDetails'])->name('blog.details');

Route::get('sign-in', [UserLogincontroller::class, 'signIn'])->name('sign.in');
Route::get('sign-up', [UserLogincontroller::class, 'signUp'])->name('sign.up');


Route::prefix('user')->name('user.')->group(function () {
    Route::post('login-details-submit', [UserLogincontroller::class, 'loginDetailsSubmit'])->name('login-details-submit');

    Route::middleware(['auth:web'])->group(function () {
        //Protected Route start
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
    });
});

Route::prefix('proof-reader')->name('proof-reader.')->group(function () {
    Route::get('login', [ReaderController::class, 'login'])->name('login');
    Route::post('login/submit', [ReaderController::class, 'loginSubmit'])->name('login.submit');
    Route::middleware(['auth:reader'])->group(function () {
        //Protected Route start
        Route::get('dashboard', [ReaderController::class, 'dashboard'])->name('dashboard');
        Route::get('logout', [ReaderController::class, 'logout'])->name('logout');
    });
});
