<?php

use App\Http\Controllers\{
    AdminController,
    ApplicationDataController,
    ApplicationFormController,
    ApprovalController,
    BuildingPermitFormController,
    BusinessPermitFormController,
    CreateController,
    DocumentController,
    HistoryController,
    InboxController,
    MainController,
    NotificationController,
    RequestController,
    UploadController,
    UserController
};
use App\Http\Controllers\API\RequirementController;
use App\Models\ChatMessage;
use App\Models\Google;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

/*
|------------------------------- -------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::middleware('auth')->group(function () {
    // Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
    // Route::prefix('/forms')->group(function(){
    //     Route::inertia('/business-permit','Forms/BuildingPermit')->name('businessPermitForm');
    // });


    Route::prefix('/requirements')->group(function () {
        Route::inertia('/', 'Client/DocumentView')->name('documentview');
        Route::inertia('/businesspermit', 'Client/DocumentViewBusinessPermit')->name('documentviewbusiness');
        Route::inertia('/buildingpermit', 'Client/DocumentViewBldgPermit')->name('documentviewbldg');
        // Route::inertia('/renewal', 'Client/DocumentViewRenewal')->name('documentviewrenewal');
        Route::get('/businesspermit', [MainController::class, 'getBusinessReqs'])->name('documentviewbusiness');
        Route::get('/buildingpermit', [MainController::class, 'getBuildingReqs'])->name('documentviewbldg');
        Route::get('/renewal', [MainController::class, 'getBusinessRenewalReqs'])->name('documentviewrenewal');

        Route::get("/getClientApplicationRequirementData", [RequirementController::class, 'getClientApplicationRequirementData'])->name('getClientApplicationRequirementData');
    });
    Route::prefix('/application')->group(function () {
        Route::inertia('/', 'Client/ApplicationForm')->name('applicationform');

        Route::prefix('/businesspermit')->group(function () {
            Route::get('/', [ApplicationFormController::class, 'renderBusinessPermitForm'])->name('renderBusinessPermitForm');
            Route::get('/{application_id}', [ApplicationFormController::class, 'renderBusinessPermitRequirements'])->name('businessPermitApplicationId');
            Route::post("/store", [ApplicationDataController::class, 'store'])->name('storeApplicationData');
        });


        Route::post('/store', [ApplicationFormController::class, 'store'])->name('applicationform.store');


        Route::post('/update/{id}', [ApplicationFormController::class, 'update'])->name('applicationform.update');

        // Route::inertia('/buildingpermitform', 'Client/Forms/BldgPermitForm')->name('buildingpermitform');
        Route::get('/buildingpermitform', [ApplicationFormController::class, 'getBuildingReqs'])->name('buildingpermitform');
        Route::post('/buildingpermitform', [BuildingPermitFormController::class, 'store']);

        Route::get('/renewalform', [ApplicationFormController::class, 'getBusinessRenewalReqs'])->name('renewalform');
        // Route::inertia('/renewalform', 'Client/Forms/RenewalForm')->name('renewalform');
    });
    Route::prefix('/my-application-forms')->group(function () {
        Route::get('/', [ApplicationFormController::class, 'getSubmittedForms'])->name('my-application-forms');
        Route::get('/getRecord', [ApplicationFormController::class, 'getRecords'])->name('my-application-forms-record');
        Route::get('/returned/{title}/{id}', [ApplicationFormController::class, 'returned'])->name('returned');
        // Route::get('/getRecord', [ApplicationFormController::class, 'getSubmittedForms']);
    });

    Route::get('/userProfile', [UserController::class, 'index'])->name('account');
    Route::post('/userProfile-update', [UserController::class, 'update'])->name('account.update');
    Route::prefix('/notifications')
        ->controller(NotificationController::class)
        ->group(function () {
            Route::get('/', 'index')->name('notifications');
            Route::get('/{notification}', 'getRecord')->name('notification.getrecord');
            Route::get('/getRecord', 'index')->name('notifications.getrecord.index');
        });

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    // Route::inertia('/notifications', 'Client/Notification')->name('notifications');
    Route::post('/logout', [MainController::class, 'logout'])->name('logout');


    Route::prefix('/inbox')
        ->controller(InboxController::class)
        ->name('inbox.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/chat/{friend}', 'userInbox')->name('chat');
        });

    /**
     * Handles the route groups for admin
     */

    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::post('/registeradmin', [MainController::class, 'registeradmin'])->name('adminreg');

        Route::get('/{query}/{type}', [AdminController::class, 'views'])->name('types');
        Route::get('/show', [CreateController::class, 'index'])->name('showAdmin');
        Route::get('/create', [CreateController::class, 'create'])->name('create');

        Route::prefix('/dashboard')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('dashboard');
            // Route::inertia('/businesspermit', 'Admin/Dashboard/Partials/AdminDocumentViewBusinessPermit')->name('documentviewbusiness');
            // Route::inertia('/buildingpermit', 'Admin/Dashboard/Partials/AdminDocumentViewBldgPermit')->name('documentviewbldg');
            // Route::inertia('/renewal', 'Admin/Dashboard/Partials/AdminDocumentViewRenewalPermit')->name('documentviewrenewal');
            Route::get('/businesspermit', [AdminController::class, 'getBusinessReqs'])->name('documentviewbusiness');
            Route::get('/buildingpermit', [AdminController::class, 'getBuildingReqs'])->name('documentviewbldg');
            Route::get('/renewal', [AdminController::class, 'getBusinessRenewalReqs'])->name('documentviewrenewal');
        });

        Route::prefix('/documents')
            ->controller(DocumentController::class)
            ->group(function () {
                Route::get('/', 'index')->name('documents.index');
                Route::post('/category/store', 'addCategory')->name('document.addcategory');
                Route::post('/subcategory/store', 'addSubcategory')->name('document.addsubcategory');
                Route::post('/requirement/store', 'addRequirement')->name('document.addrequirement');
                Route::delete('/category/{id}', 'deleteCategory')->name('document.deleteCategory');
                Route::delete('/subcategory/{id}', 'deleteSubcategory')->name('document.deleteSubcategory');
                Route::delete('/requirement/{id}', 'deleteRequirement')->name('document.deleteRequirement');
            });

        Route::prefix('/uploads')
            ->controller(UploadController::class)
            ->group(function () {
                Route::get('/', 'index')->name('uploads.index');
                Route::post('/upload', 'upload')->name('uploads.store');
            });

        Route::prefix('/requests')->name('requests.')
            ->controller(RequestController::class)
            ->group(function () {
                Route::get('/', 'emailRequest')->name('index');
                Route::get('/email', 'emailRequest')->name('email');
                Route::post('/send-email', 'sendEmail')->name('send-email');
            });
        Route::post('/approval/getRecord', [ApprovalController::class, 'getRecord'])->name('approval.getrecord');

        Route::prefix('/approval')
            ->controller(ApprovalController::class)
            ->group(function () {
                Route::get('/isCheck', 'isCheck')->name('approval.isCheck');
                Route::get('/search', 'search')->name('approval.search');
                Route::get('/', 'index')->name('approval.index');
                Route::post('/changeStatus', 'changeStatus')->name('approval.changestatus');
                Route::get('/getRecord', 'index')->name('approval.getrecord.index');
                Route::post('/addDocumentRemarks', 'addDocumentRemarks')->name('approval.addDocumentRemarks');
            });

        Route::prefix('/history')
            ->controller(HistoryController::class)
            ->group(function () {
                Route::get('/', 'index')->name('history.index');
            });
    });

    Route::get('/chat/{friend}', [InboxController::class, 'getMessages'])->name('chat');
    Route::post('/chat/send', [InboxController::class, 'sendMessage'])->name('chat.send');
    Route::get('/notification/count', [NotificationController::class, 'getNotificationCount'])->name('notification.count');
    Route::get('/inbox/count', [InboxController::class, 'inboxCount'])->name('inbox.count');
});
Route::middleware('guest')->group(function () {
    // Route::inertia('/', 'Home')->name('home');
    Route::get('/', [MainController::class, 'home'])->name('home');

    // Route::inertia('/register', 'Auth/Register')->name('register');
    Route::get('/register', [MainController::class, 'registerIndex'])->name('register');
    Route::post('/register', [MainController::class, 'register'])->name('reg');

    // Route::inertia('/login', 'Auth/Login')->name('login');
    Route::inertia('/map', 'Components/Map')->name('map');
    Route::get('/login', [MainController::class, 'loginIndex'])->name('login.index');
    Route::post('/login', [MainController::class, 'login'])->name('login');

    Route::get('/auth/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('google.login');

    Route::get('/auth/google/callback', function () {
        $googleUser = Socialite::driver('google')->user();

        // Check if the user already exists in the database
        $user = User::firstOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'username' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'password' => "testfile", // Set a random password for the user
            'login_type' => 'google',

        ]);

        // Log the user in
        Auth::login($user);

        return redirect()->route('documentview'); // or wherever you want to redirect
    });
});
