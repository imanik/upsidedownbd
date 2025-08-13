<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountCategoryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FcategoryController;
use App\Http\Controllers\FmenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\RescheduleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/test', [DashboardController::class, 'test'])->name('test');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/check', [TicketController::class, 'check'])->name('check');

    Route::name('profile.')->prefix('profile')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
        Route::patch('', [ProfileController::class, 'update']);
        Route::get('password', [ProfileController::class, 'password'])->name('password');
        Route::patch('password', [ProfileController::class, 'passwordUpdate']);
    });

    Route::get('/settings', [SettingController::class, 'create'])->middleware('access')->name('settings');
    Route::post('/settings', [SettingController::class, 'store'])->middleware('access')->name('settings.store');

    Route::name('branch.')->prefix('branches')->middleware('access')->group(function () {
        Route::get('/', [BranchController::class, 'index'])->name('index');
        Route::get('/create', [BranchController::class, 'create'])->name('create');
        Route::post('/store', [BranchController::class, 'store'])->name('store');

        Route::get('/{branch:id}/show', [BranchController::class, 'show'])->name('show');
        Route::get('/{branch:id}/edit', [BranchController::class, 'edit'])->name('edit');
        Route::patch('/{branch:id}/update', [BranchController::class, 'update'])->name('update');
        Route::delete('/{branch:id}/destroy', [BranchController::class, 'destroy'])->name('destroy');
    });


    Route::name('slot.')->prefix('slots')->middleware('access')->group(function () {
        Route::get('/', [SlotController::class, 'index'])->name('index');
        Route::get('/create', [SlotController::class, 'create'])->name('create');
        Route::post('/store', [SlotController::class, 'store'])->name('store');

        Route::get('/{slot:id}/show', [SlotController::class, 'show'])->name('show');
        Route::get('/{slot:id}/edit', [SlotController::class, 'edit'])->name('edit');
        Route::patch('/{slot:id}/update', [SlotController::class, 'update'])->name('update');
        Route::delete('/{slot:id}/destroy', [SlotController::class, 'destroy'])->name('destroy');
    });

    Route::name('facility.')->prefix('facilities')->middleware('access')->group(function () {
        Route::get('/', [FacilityController::class, 'index'])->name('index');
        Route::get('/create', [FacilityController::class, 'create'])->name('create');
        Route::post('/store', [FacilityController::class, 'store'])->name('store');

        Route::get('/{facility:id}/show', [FacilityController::class, 'show'])->name('show');
        Route::get('/{facility:id}/edit', [FacilityController::class, 'edit'])->name('edit');
        Route::patch('/{facility:id}/update', [FacilityController::class, 'update'])->name('update');
        Route::delete('/{facility:id}/destroy', [FacilityController::class, 'destroy'])->name('destroy');
    });

    Route::name('bundle.')->prefix('bundles')->middleware('access')->group(function () {
        Route::get('/', [BundleController::class, 'index'])->name('index');
        Route::get('/create', [BundleController::class, 'create'])->name('create');
        Route::post('/store', [BundleController::class, 'store'])->name('store');

        Route::get('/{bundle:id}/show', [BundleController::class, 'show'])->name('show');
        Route::get('/{bundle:id}/edit', [BundleController::class, 'edit'])->name('edit');
        Route::patch('/{bundle:id}/update', [BundleController::class, 'update'])->name('update');
        Route::delete('/{bundle:id}/destroy', [BundleController::class, 'destroy'])->name('destroy');
    });


    Route::name('coupon.')->prefix('coupons')->middleware('access')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::get('/create', [CouponController::class, 'create'])->name('create');
        Route::post('/store', [CouponController::class, 'store'])->name('store');

        Route::get('/{coupon:id}/show', [CouponController::class, 'show'])->name('show');
        Route::get('/{coupon:id}/edit', [CouponController::class, 'edit'])->name('edit');
        Route::patch('/{coupon:id}/update', [CouponController::class, 'update'])->name('update');
        Route::delete('/{coupon:id}/destroy', [CouponController::class, 'destroy'])->name('destroy');
    });
    
    
    Route::name('invite.')->prefix('invites')->middleware('access')->group(function () {
        Route::get('/', [InviteController::class, 'index'])->name('index');
        Route::get('/create', [InviteController::class, 'create'])->name('create');

        Route::get('/csv', [InviteController::class, 'csv'])->name('csv'); // localhost:8000/
        Route::post('/uploadFile', [InviteController::class, 'uploadFile'])->name('upload');
        
        //Route::post('/store', [InviteController::class, 'store'])->name('store');
        Route::get('invite/{id}/mail', [InviteController::class, 'coupon_mail'])->name('coupon');

        //  Route::get('/{invite:id}/show', [InviteController::class, 'show'])->name('show');
        //  Route::get('/{invite:id}/edit', [InviteController::class, 'edit'])->name('edit');
        //  Route::patch('/{invite:id}/update', [InviteController::class, 'update'])->name('update');
        Route::delete('/{invite:id}/destroy', [InviteController::class, 'destroy'])->name('destroy'); 
       
    });

    Route::name('franchiser.')->prefix('franchisers')->middleware('access')->group(function () {
        Route::get('/', [App\Http\Controllers\FranchiseController::class, 'index'])->name('index');
        Route::delete('/{franchiser:id}/destroy', [App\Http\Controllers\FranchiseController::class, 'destroy'])->name('destroy');
     //   Route::get('/create', [FranchiseController::class, 'create'])->name('create');
        
       
    });

    Route::name('attendance.')->prefix('attendances')->middleware('access')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('index');
        Route::get('/create', [AttendanceController::class, 'create'])->name('create');
        Route::post('/store', [AttendanceController::class, 'store'])->name('store');

        Route::get('/{attendance:id}/show', [AttendanceController::class, 'show'])->name('show');
        Route::get('/{attendance:id}/edit', [AttendanceController::class, 'edit'])->name('edit');
        Route::patch('/{attendance:id}/update', [AttendanceController::class, 'update'])->name('update');
        Route::delete('/{attendance:id}/destroy', [AttendanceController::class, 'destroy'])->name('destroy');
    });

    Route::name('ticket.')->prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');

        Route::get('/{ticket:id}/show', [TicketController::class, 'show'])->name('show');
        Route::get('/{ticket:id}/edit', [TicketController::class, 'edit'])->name('edit');

        Route::patch('/{ticket:id}/update', [TicketController::class, 'update'])->name('update');
        Route::delete('/{ticket:id}/destroy', [TicketController::class, 'destroy'])->name('destroy');
        Route::get('/{ticket:id}/refund', [TicketController::class, 'refund'])->name('refund');

        Route::get('/{ticket:id}/ticket-edit', [TicketController::class, 'ticket_edit'])->name('ticket_edit');
        Route::patch('/{ticket:id}/ticket-update', [TicketController::class, 'ticket_update'])->name('ticket_update');
    });

    Route::name('role.')->prefix('roles')->middleware('access')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');

        Route::get('/{role:id}/show', [RoleController::class, 'show'])->name('show');
        Route::get('/{role:id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::patch('/{role:id}/update', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role:id}/destroy', [RoleController::class, 'destroy'])->name('destroy');

        Route::get('/{role:id}/permission', [RoleController::class, 'permission'])->name('permission.edit');
        Route::patch('/{role:id}/permission', [RoleController::class, 'permissionUpdate'])->name('permission.update');
    });



    Route::name('user.')->prefix('users')->middleware('access')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');

        Route::get('/{user:id}/show', [UserController::class, 'show'])->name('show');
        Route::get('/{user:id}/login', [UserController::class, 'auto_login'])->name('auto_login');
        Route::get('/{user:id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{user:id}/update', [UserController::class, 'update'])->name('update');
        Route::delete('/{user:id}/destroy', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/{user}/properties', [UserController::class, 'property'])->name('property');
    });

    Route::name('designation.')->prefix('designations')->middleware('access')->group(function () {
        Route::get('/', [DesignationController::class, 'index'])->name('index');
        Route::get('/create', [DesignationController::class, 'create'])->name('create');
        Route::post('/store', [DesignationController::class, 'store'])->name('store');

        Route::get('/{designation:id}/show', [DesignationController::class, 'show'])->name('show');
        Route::get('/{designation:id}/edit', [DesignationController::class, 'edit'])->name('edit');
        Route::patch('/{designation:id}/update', [DesignationController::class, 'update'])->name('update');
        Route::delete('/{designation:id}/destroy', [DesignationController::class, 'destroy'])->name('destroy');
    });

    Route::name('employee.')->prefix('employees')->middleware('access')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');

        Route::get('/{employee:id}/show', [EmployeeController::class, 'show'])->name('show');
        Route::get('/{employee:id}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::patch('/{employee:id}/update', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{employee:id}/destroy', [EmployeeController::class, 'destroy'])->name('destroy');
    });

    Route::name('payment.')->prefix('payments')->middleware('access')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/{payment:id}/show', [PaymentController::class, 'show'])->name('show');
        Route::get('/{payment:id}/edit', [PaymentController::class, 'edit'])->name('edit');
        Route::patch('/{payment:id}/update', [PaymentController::class, 'update'])->name('update');
        Route::delete('/{payment:id}/destroy', [PaymentController::class, 'destroy'])->name('destroy');
    });

    Route::name('refund.')->prefix('refunds')->middleware('access')->group(function () {
        Route::get('/', [RefundController::class, 'index'])->name('index');
        Route::get('/{refund:id}/show', [RefundController::class, 'show'])->name('show');
        Route::get('/{refund:id}/edit', [RefundController::class, 'edit'])->name('edit');
        Route::patch('/{refund:id}/update', [RefundController::class, 'update'])->name('update');
        Route::delete('/{refund:id}/destroy', [RefundController::class, 'destroy'])->name('destroy');
    });

    Route::name('reschedule.')->prefix('reschedules')->middleware('access')->group(function () {
        Route::get('/', [RescheduleController::class, 'index'])->name('index');
        Route::get('/{reschedule:id}/show', [RescheduleController::class, 'show'])->name('show');
        Route::get('/{reschedule:id}/edit', [RescheduleController::class, 'edit'])->name('edit');
        Route::patch('/{reschedule:id}/update', [RescheduleController::class, 'update'])->name('update');
        Route::delete('/{reschedule:id}/destroy', [RescheduleController::class, 'destroy'])->name('destroy');
    });


    Route::name('fmenu.')->prefix('fmenus')->middleware('access')->group(function () {
        Route::get('/', [FmenuController::class, 'index'])->name('index');
        Route::get('/create', [FmenuController::class, 'create'])->name('create');
        Route::post('/store', [FmenuController::class, 'store'])->name('store');

        Route::get('/{fmenu:id}/show', [FmenuController::class, 'show'])->name('show');
        Route::get('/{fmenu:id}/edit', [FmenuController::class, 'edit'])->name('edit');
        Route::patch('/{fmenu:id}/update', [FmenuController::class, 'update'])->name('update');
        Route::delete('/{fmenu:id}/destroy', [FmenuController::class, 'destroy'])->name('destroy');
    });

    Route::name('fcategory.')->prefix('fcategories')->middleware('access')->group(function () {
        Route::get('/', [FcategoryController::class, 'index'])->name('index');
        Route::get('/create', [FcategoryController::class, 'create'])->name('create');
        Route::post('/store', [FcategoryController::class, 'store'])->name('store');

        Route::get('/{fcategory:id}/show', [FcategoryController::class, 'show'])->name('show');
        Route::get('/{fcategory:id}/edit', [FcategoryController::class, 'edit'])->name('edit');
        Route::patch('/{fcategory:id}/update', [FcategoryController::class, 'update'])->name('update');
        Route::delete('/{fcategory:id}/destroy', [FcategoryController::class, 'destroy'])->name('destroy');
    });




    Route::name('accountcategory.')->prefix('accountcategories')->middleware('access')->group(function () {
        Route::get('/', [AccountCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AccountCategoryController::class, 'create'])->name('create');
        Route::post('/store', [AccountCategoryController::class, 'store'])->name('store');

        Route::get('/{accountcategory:id}/show', [AccountCategoryController::class, 'show'])->name('show');
        Route::get('/{accountcategory:id}/edit', [AccountCategoryController::class, 'edit'])->name('edit');
        Route::patch('/{accountcategory:id}/update', [AccountCategoryController::class, 'update'])->name('update');
        Route::delete('/{accountcategory:id}/destroy', [AccountCategoryController::class, 'destroy'])->name('destroy');
        
        Route::get('/csv', [AccountCategoryController::class, 'csv'])->name('csv'); // localhost:8000/
        Route::post('/uploadFile', [AccountCategoryController::class, 'uploadFile'])->name('upload');
    
    });

        Route::name('account.')->prefix('accounts')->middleware('access')->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('index');
            Route::get('/summary', [AccountController::class, 'summary'])->name('summary');
            Route::get('/detail', [AccountController::class, 'detail'])->name('detail');
            Route::get('/{income:id}/show', [AccountController::class, 'show'])->name('show');
            });

    Route::name('income.')->prefix('incomes')->middleware('access')->group(function () {
        Route::get('/', [IncomeController::class, 'index'])->name('index');
        Route::get('/create', [IncomeController::class, 'create'])->name('create');
        Route::post('/store', [IncomeController::class, 'store'])->name('store');

        Route::get('/{income:id}/show', [IncomeController::class, 'show'])->name('show');
        Route::get('/{income:id}/edit', [IncomeController::class, 'edit'])->name('edit');
        Route::patch('/{income:id}/update', [IncomeController::class, 'update'])->name('update');
        Route::delete('/{income:id}/destroy', [IncomeController::class, 'destroy'])->name('destroy');

        Route::get('/csv', [IncomeController::class, 'csv'])->name('csv'); // localhost:8000/
        Route::post('/uploadFile', [IncomeController::class, 'uploadFile'])->name('upload');
    });

    
    Route::name('transaction.')->prefix('transactions')->middleware('access')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/transaction', [TransactionController::class, 'create'])->name('create');
        Route::post('/transaction', [TransactionController::class, 'store'])->name('store');

        Route::get('/{transaction:id}/show', [TransactionController::class, 'show'])->name('show');
        Route::get('/{transaction:id}/edit', [TransactionController::class, 'edit'])->name('edit');
        Route::patch('/{transaction:id}/update', [TransactionController::class, 'update'])->name('update');
        Route::delete('/{transaction:id}/destroy', [TransactionController::class, 'destroy'])->name('destroy');

        Route::get('/csv', [TransactionController::class, 'csv'])->name('csv'); // localhost:8000/
        Route::post('/uploadFile', [TransactionController::class, 'uploadFile'])->name('upload');
    });

    Route::name('expense.')->prefix('expenses')->middleware('access')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('index');
        Route::get('/create', [ExpenseController::class, 'create'])->name('create');
        Route::post('/store', [ExpenseController::class, 'store'])->name('store');

        Route::get('/{expense:id}/show', [ExpenseController::class, 'show'])->name('show');
        Route::get('/{expense:id}/edit', [ExpenseController::class, 'edit'])->name('edit');
        Route::patch('/{expense:id}/update', [ExpenseController::class, 'update'])->name('update');
        Route::delete('/{expense:id}/destroy', [ExpenseController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth')->name('customer.')->prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'customer'])->name('dashboard');

    Route::get('profile', [CustomerController::class, 'profile'])->name('profile');
    Route::patch('update', [CustomerController::class, 'profileUpdate'])->name('profile.update');
    Route::get('password', [CustomerController::class, 'password'])->name('password');
    Route::patch('password', [CustomerController::class, 'passwordUpdate'])->name('password.update');

    Route::get('/tickets', [CustomerController::class, 'tickets'])->name('tickets');
    Route::get('/bundles', [CustomerController::class, 'bundles'])->name('bundles');
});

Route::get('/bundle', [HomeController::class, 'bundle'])->name('bundle.get');
Route::post('/bundle', [HomeController::class, 'bundle_store']);
Route::get('/bundle/{reference}', [HomeController::class, 'bundle_detail'])->name('bundle.detail');

Route::get('/ticket', [HomeController::class, 'ticket'])->name('ticket.create');
Route::post('/ticket', [HomeController::class, 'ticket_store']);

Route::get('/ticket/{reference}', [HomeController::class, 'ticket_detail'])->name('ticket.detail');
Route::get('/ticket/{reference}/mail', [HomeController::class, 'ticket_mail'])->name('ticket.mail');
Route::get('/ticket/{reference}/print', [HomeController::class, 'ticket_print'])->name('ticket.print');

Route::post('/coupon-check', [HomeController::class, 'coupon_check'])->name('coupon_check');
Route::post('/slot-check', [HomeController::class, 'slot_check'])->name('slot_check');
Route::post('/branch/detail', [HomeController::class, 'branch_detail'])->name('branch.detail');

Route::get('/language', [HomeController::class, 'language'])->name('language');

Route::get('/', function () {
    return redirect()->route('home');
});

Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
Route::post('/pay-ajax', [PaymentController::class, 'payAjax'])->name('payAjax');
Route::post('/success', [PaymentController::class, 'success'])->name('success');
Route::post('/fail', [PaymentController::class, 'fail'])->name('fail');
Route::post('/cancel', [PaymentController::class, 'cancel'])->name('cancel');
Route::post('/ipn', [PaymentController::class, 'ipn'])->name('ipn');


//Route::get('invite/{id}/mail', [InviteController::class, 'coupon_mail'])->name('coupon.mail');



