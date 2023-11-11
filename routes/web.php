<?php

use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\Staff\Admin\AccountController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Staff\Admin\CMSController;
use App\Http\Controllers\Staff\Library\DatasetController;
use App\Http\Controllers\Staff\Library\PublicationController;
use App\Http\Controllers\Staff\Library\ResourceController;
use App\Http\Controllers\Staff\Service\ServiceController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\StaffForgotPasswordController;
use App\Http\Controllers\Staff\StaffLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserForgotPasswordController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegisterController;
use App\Http\Controllers\User\UserSubmissionController;
use Illuminate\Support\Facades\Storage;
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

Route::get('/', [CMSController::class, 'index']);
Route::get('/publications', [PublicationController::class, 'index']);
Route::post('/publications', [PublicationController::class, 'index']);
Route::get('/pub_id={id}', [PublicationController::class, 'viewPublication']);
Route::post('/count-view/pub_id={id}', [PublicationController::class, 'viewCount']);
Route::post('/count-view/dataset_id={id}', [DatasetController::class, 'viewCount']);
Route::get('/datasets', [DatasetController::class, 'index']);
Route::post('/datasets', [DatasetController::class, 'index']);
Route::get('/dataset_id={id}', [DatasetController::class, 'viewDataset']);
Route::get('/blog_id={id}', [CMSController::class, 'viewAnnouncement']);

Route::get('/maintenance', function () { return view('error-pages/maintenance');});

Route::post('/submit-concern', [UserController::class, 'concern'])->name('concern');




//////////////////////////  REGISTER DEFAULT AUTH ROUTES
Auth::routes();



//////////////////////////  USER LOGIN/REGISTER
Route::middleware(['guest:web', 'prevent-back'])->group(function(){
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserLoginController::class, 'login'])->name('login.check');
    Route::get('/register', [UserRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register-next', [UserRegisterController::class, 'registerFirst'])->name('register.first.store');
    Route::post('/register-last', [UserRegisterController::class, 'registerSecond'])->name('register.second.store');

    ////////////////////////// OTP
    Route::get('/verify-otp/token={token}', [UserRegisterController::class, 'showOTPForm'])->name('otp.form');
    Route::post('/verify-otp', [UserRegisterController::class, 'verifyOTP'])->name('otp.verify');
    Route::post('/resend-otp', [UserRegisterController::class, 'resendOTP'])->name('otp.resend');

    Route::get('password/reset', [UserForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [UserForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); 
    Route::get('password/reset/{token}', [UserForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [UserForgotPasswordController::class, 'reset'])->name('password.update');

    
});

Route::middleware(['auth:sanctum,web', 'prevent-back'])->group(function(){
    // Route::view('/dashboard', 'dashboard.user.dashboard')->name('dashboard');

    Route::get('/profile',[UserController::class, 'editProfile'])->name('profile');
    Route::post('/profile/update/id={id}', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/download-history', [UserController::class, 'downloadHistory'])->name('history');

    Route::view('password/change', 'dashboard.auth-user.change');
    Route::post('password/change/id={id}', [UserController::class, 'updatePassword'])->name('password.change');


    Route::post('download/pub_id={id}', [UserController::class, 'downloadPublication']);
    Route::post('download/dataset_id={id}', [UserController::class, 'downloadDataset']);

    Route::get('/submission-publication', [UserSubmissionController::class, 'submissionPublication'])->name('submission.publication');
    Route::post('/submission-publication', [UserSubmissionController::class, 'storePublication'])->name('submission.publication.store');

    Route::get('/service-request', [UserSubmissionController::class, 'serviceRequest'])->name('service.request');
    Route::post('/service-request', [UserSubmissionController::class, 'storeServiceRequest'])->name('service.request.store');

    Route::get('/request-history', [UserSubmissionController::class, 'requests']);
    
});




//////////////////////////  STAFF LOGIN
Route::prefix('staff')->name('staff.')->group(function(){
    Route::middleware(['guest:staff', 'prevent-back'])->group(function(){
        Route::get('/login', [StaffLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [StaffLoginController::class, 'login'])->name('login.check');


        ////////////////////////// FORGOT/RESET PASSWORD
        Route::get('password/reset', [StaffForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [StaffForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); 
        Route::get('password/reset/{token}', [StaffForgotPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [StaffForgotPasswordController::class, 'reset'])->name('password.update');

    });
});
        //////////////////////////  STAFF LOGOUT
        Route::post('staff/logout', [StaffLoginController::class, 'logout'])->name('staff.logout')->middleware('auth:staff');


//////////////////////////  ADMIN ROUTES
Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['auth-staff:sanctum,staff', 'prevent-back', 'role:Admin'])->group(function(){
        Route::get('/dashboard', [StaffController::class, 'analyticsAdmin'])->name('dashboard');

        Route::get('/profile/id={id}',[StaffController::class, 'editProfile'])->name('profile');
        Route::post('/profile/update/id={id}', [StaffController::class, 'updateProfile'])->name('profile.update');

        ////////////////////////// UPDATE PASSWORD
        // Route::view('password/change/id={id}', 'auth-staff.passwords.staff-change-password');
        Route::post('password/change/id={id}', [StaffController::class, 'updatePassword'])->name('password.change');

        ////////////////////////// CRUD - STAFF
        Route::get('/staffs', [AccountController::class, 'staff'])->name('staffs');
        Route::post('/staffs/add', [AccountController::class, 'storeStaff'])->name('store.staffs');
        Route::get('/staffs/edit/id={id}', [AccountController::class, 'editStaff'])->name('edit.staffs');
        Route::put('/staffs/update/id={id}', [AccountController::class, 'updateStaff'])->name('update.staffs');
        Route::delete('/staffs/delete/id={id}', [AccountController::class, 'deleteStaff'])->name('delete.staffs');

 
        ////////////////////////// CRUD - USER
        Route::get('/users', [AccountController::class, 'user'])->name('users');
        Route::get('/users/view/id={id}', [AccountController::class, 'viewUser'])->name('view.users');
        Route::get('/users/edit/id={id}', [AccountController::class, 'editUser'])->name('edit.users');
        Route::put('/users/update/id={id}', [AccountController::class, 'updateUser'])->name('update.users');
        Route::delete('/users/delete/id={id}', [AccountController::class, 'deleteUser'])->name('delete.users');

        ////////////////////////// CRUD - CMS
        Route::get('/sliders', [CMSController::class, 'slider'])->name('sliders');
        Route::post('/sliders/add', [CMSController::class, 'storeSlider'])->name('store.sliders');
        Route::get('/sliders/edit/id={id}', [CMSController::class, 'editSlider'])->name('edit.sliders');
        Route::put('/sliders/update/id={id}', [CMSController::class, 'updateSlider'])->name('update.sliders');
        Route::delete('/sliders/delete/id={id}', [CMSController::class, 'deleteSlider'])->name('delete.sliders');
        
        Route::get('/announcements', [CMSController::class, 'announcement'])->name('announcements');
        Route::post('/announcements/add', [CMSController::class, 'storeAnnouncement'])->name('store.announcements');
        Route::get('/announcements/view/id={id}', [CMSController::class, 'viewAnnouncement'])->name('view.announcements');
        Route::get('/announcements/edit/id={id}', [CMSController::class, 'editAnnouncement'])->name('edit.announcements');
        Route::put('/announcements/update/id={id}', [CMSController::class, 'updateAnnouncement'])->name('update.announcements');
        Route::delete('/announcements/delete/id={id}', [CMSController::class, 'deleteAnnouncement'])->name('delete.announcements');

        Route::get('/galleries', [CMSController::class, 'gallery'])->name('galleries');
        Route::post('/galleries/add', [CMSController::class, 'storeGallery'])->name('store.galleries');
        Route::get('/galleries/view/id={id}', [CMSController::class, 'viewGallery'])->name('view.galleries');
        Route::get('/galleries/edit/id={id}', [CMSController::class, 'editGallery'])->name('edit.galleries');
        Route::put('/galleries/update/id={id}', [CMSController::class, 'updateGallery'])->name('update.galleriess');
        Route::delete('/galleries/delete/id={id}', [CMSController::class, 'deleteGallery'])->name('delete.galleries');



        ////////////////////////// CRUD - PUBLICATION
        Route::get('/publications', [PublicationController::class, 'publication'])->name('publications');
        Route::post('/publications/add', [PublicationController::class, 'storePublication'])->name('store.publications');
        Route::get('/publications/edit/id={id}', [PublicationController::class, 'editPublication'])->name('edit.publications');
        Route::put('/publications/update/id={id}', [PublicationController::class, 'updatePublication'])->name('update.publications');
        Route::delete('/publications/delete/id={id}', [PublicationController::class, 'deletePublication'])->name('delete.publications');

        Route::get('/publications/requests', [PublicationController::class, 'publicationRequests'])->name('publications.requests');
        Route::post('/publications/requests/approve/id={id}', [PublicationController::class, 'approve']);
        Route::post('/publications/requests/reject/id={id}', [PublicationController::class, 'reject']);
        
        ////////////////////////// CRUD - DATASET
        Route::get('/datasets', [DatasetController::class, 'dataset'])->name('datasets');
        Route::post('/datasets/add', [DatasetController::class, 'storeDataset'])->name('store.datasets');
        Route::get('/datasets/edit/id={id}', [DatasetController::class, 'editDataset'])->name('edit.datasets');
        Route::put('/datasets/update/id={id}', [DatasetController::class, 'updateDataset'])->name('update.datasets');
        Route::delete('/datasets/delete/id={id}', [DatasetController::class, 'deleteDataset'])->name('delete.datasets');

        Route::get('/services/requests', [ServiceController::class, 'serviceRequests'])->name('services.requests');
        Route::post('/services/requests/approve/id={id}', [ServiceController::class, 'approve']);
        Route::post('/services/requests/reject/id={id}', [ServiceController::class, 'reject']);

        Route::get('/generate-report/users', [StaffController::class, 'generateUserReport']);
        Route::get('/generate-report/submissions', [StaffController::class, 'generateSubmissionReport']);
        Route::get('/generate-report/downloads', [StaffController::class, 'generateDownloadReport']);
    });
});



//////////////////////////  LIBRARY ROUTES
Route::prefix('libr')->name('libr.')->group(function(){
    Route::middleware(['auth-staff:sanctum,staff', 'prevent-back', 'role:Library Staff'])->group(function(){
        Route::get('/dashboard', [StaffController::class, 'analyticsLibrary'])->name('dashboard');
        Route::get('/profile/id={id}',[StaffController::class, 'editProfile'])->name('profile');
        Route::post('/profile/update/id={id}', [StaffController::class, 'updateProfile'])->name('profile.update');

        ////////////////////////// UPDATE PASSWORD
        Route::view('password/change/id={id}', 'auth-staff.passwords.staff-change-password');
        Route::post('password/change/id={id}', [StaffController::class, 'updatePassword'])->name('password.change');

        ////////////////////////// CRUD - PUBLICATION
        Route::get('/publications', [PublicationController::class, 'publication'])->name('publications');
        Route::post('/publications/add', [PublicationController::class, 'storePublication'])->name('store.publications');
        Route::get('/publications/edit/id={id}', [PublicationController::class, 'editPublication'])->name('edit.publications');
        Route::put('/publications/update/id={id}', [PublicationController::class, 'updatePublication'])->name('update.publications');
        Route::delete('/publications/delete/id={id}', [PublicationController::class, 'deletePublication'])->name('delete.publications');

        Route::get('/publications/requests', [PublicationController::class, 'publicationRequests'])->name('publications.requests');
        Route::post('/publications/requests/approve/id={id}', [PublicationController::class, 'approve']);
        Route::post('/publications/requests/reject/id={id}', [PublicationController::class, 'reject']);
        
        ////////////////////////// CRUD - DATASET
        Route::get('/datasets', [DatasetController::class, 'dataset'])->name('datasets');
        Route::post('/datasets/add', [DatasetController::class, 'storeDataset'])->name('store.datasets');
        Route::get('/datasets/edit/id={id}', [DatasetController::class, 'editDataset'])->name('edit.datasets');
        Route::put('/datasets/update/id={id}', [DatasetController::class, 'updateDataset'])->name('update.datasets');
        Route::delete('/datasets/delete/id={id}', [DatasetController::class, 'deleteDataset'])->name('delete.datasets');

        Route::get('/generate-report/submissions', [StaffController::class, 'generateSubmissionReportLibrary']);
        Route::get('/generate-report/downloads', [StaffController::class, 'generateDownloadReport']);

    });
});



//////////////////////////  SERVICE ROUTES
Route::prefix('serv')->name('serv.')->group(function(){
    Route::middleware(['auth-staff:sanctum,staff', 'prevent-back', 'role:Service Staff'])->group(function(){
        Route::get('/dashboard', [StaffController::class, 'analyticsService'])->name('dashboard');
        Route::get('/profile/id={id}',[StaffController::class, 'editProfile'])->name('profile');
        Route::post('/profile/update/id={id}', [StaffController::class, 'updateProfile'])->name('profile.update');
        
        ////////////////////////// UPDATE PASSWORD
        Route::view('password/change/id={id}', 'auth-staff.passwords.staff-change-password');
        Route::post('password/change/id={id}', [StaffController::class, 'updatePassword'])->name('password.change');

        Route::get('/services/requests', [ServiceController::class, 'serviceRequests'])->name('services.requests');
        Route::post('/services/requests/approve/id={id}', [ServiceController::class, 'approve']);
        Route::post('/services/requests/reject/id={id}', [ServiceController::class, 'reject']);

        Route::get('/generate-report/submissions', [StaffController::class, 'generateSubmissionReportService']);
    });
});
