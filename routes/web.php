<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Backup\BackupController;
use App\Http\Controllers\Support\TicketController;
use App\Http\Controllers\Billing\PaymentController;
use App\Http\Controllers\Billing\InvoiceController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductCategoryController;
use App\Http\Controllers\Billing\BillingCycleController;
use App\Http\Controllers\Clients\UserController;
use App\Http\Controllers\Billing\PaymentGatewayController;
use App\Http\Controllers\Billing\CashTransactionController;
use App\Http\Controllers\Billing\PaymentAccountController;

Route::middleware(['auth', 'verified'])->group(function () {

    // =====================
    // Dashboard
    // =====================
    Route::get('/', function () {
        return view('Dashboard');
    })->name('dashboard');

    // =====================
    // Profile
    // =====================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // =====================
    // Client Management
    // =====================
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/register', [UserController::class, 'create'])->name('user.register');
    Route::post('/users/register', [UserController::class, 'store'])->name('user.store'); 
    Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');




    // =====================
    // Product Category Management
    // =====================

    Route::prefix('products')->name('products.')->group(function () {
        // Routes for product management
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');

        // Routes for product category management
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [ProductCategoryController::class, 'index'])->name('index');
            Route::get('/create', [ProductCategoryController::class, 'create'])->name('create');
            Route::post('/', [ProductCategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductCategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProductCategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [ProductCategoryController::class, 'destroy'])->name('destroy');
        });
    });



    // =====================
    // Order Management
    // =====================
    Route::resource('orders', OrderController::class);
    Route::prefix('orders')->name('orders.')->controller(OrderController::class)->group(function () {

        // Update the status of an order
        Route::get('/status/{status}', 'status')->name('status');

        // Track the order
        Route::get('/track/{id}', 'trackOrder')->name('track');

        // Client-Wise Products
        Route::get('/client/{clientId}/products', 'clientProducts')->name('client-products');

        // Product Stock & Order Processing Time
        Route::get('/product/{productId}/check-stock',  'checkStock')->name('check-stock');

        // // Billing Cycle Options
        // Route::get('/billing-options', [OrderController::class, 'billingOptions'])->name('billing-options');
    });


    // Client Order Status Change Route
    Route::prefix('orders')->name('orders.')->controller(UserController::class)->group(function () {
      Route::get('/status/{status}', 'status')->name('status');
    });

    // Billing Cycle Routes
    Route::resource('billing-cycles', BillingCycleController::class);

    

        // =====================
        // Invoice & Payment System Routes
        // =====================

        Route::prefix('invoices')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
            Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
            Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store');
            Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
            Route::get('/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
            Route::put('/{invoice}', [InvoiceController::class, 'update'])->name('invoice.update');
            Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
            Route::get('/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');
            Route::get('/status/{status}', [InvoiceController::class, 'filterByStatus'])->name('invoice.filterByStatus');
        });



        // Payment Routes
        Route::prefix('payments')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
            Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
            Route::post('/', [PaymentController::class, 'store'])->name('payments.store');
            // Put report BEFORE {payment} route
            Route::get('/report', [PaymentController::class, 'generateReport'])->name('payments.report');

            // Keep this last to avoid conflicts
            Route::get('/{payment}', [PaymentController::class, 'show'])->name('payments.show');
        });


        // // Payment Gateways routes
        // Route::prefix('payment-gateways')->name('payment-gateways.')->group(function () {
        //     Route::get('/', [PaymentGatewayController::class, 'index'])->name('index');
        //     Route::get('/create', [PaymentGatewayController::class, 'create'])->name('create');
        //     Route::post('/', [PaymentGatewayController::class, 'store'])->name('store');
        //     Route::get('/{gateway}/edit', [PaymentGatewayController::class, 'edit'])->name('edit');
        //     Route::put('/{gateway}', [PaymentGatewayController::class, 'update'])->name('update');
        //     Route::delete('/{gateway}', [PaymentGatewayController::class, 'destroy'])->name('destroy');
        // });

        // // Payment Accounts routes
        // Route::prefix('payment-accounts')->name('payment-accounts.')->group(function () {
        //     Route::get('/', [PaymentAccountController::class, 'index'])->name('index');
        //     Route::get('/create', [PaymentAccountController::class, 'create'])->name('create');
        //     Route::post('/', [PaymentAccountController::class, 'store'])->name('store');
        //     Route::get('/{account}/edit', [PaymentAccountController::class, 'edit'])->name('edit');
        //     Route::put('/{account}', [PaymentAccountController::class, 'update'])->name('update');
        //     Route::delete('/{account}', [PaymentAccountController::class, 'destroy'])->name('destroy');
        // });

        // // Cash Transactions routes
        Route::prefix('cash-transactions')->name('cash-transactions.')->group(function () {
                Route::get('/', [CashTransactionController::class, 'index'])->name('index');
                Route::get('/report', [CashTransactionController::class, 'report'])->name('report');
                Route::get('/create', [CashTransactionController::class, 'create'])->name('create');
                Route::post('/', [CashTransactionController::class, 'store'])->name('store');
        });





    // // =====================
    // // Support & Ticket System
    // // =====================
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');


    
    // // =====================
    // // Financial Reports & Expenses
    // // =====================
    // Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    // Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');

    // // =====================
    // // System Settings (Admin Only)
    // // =====================


    // // =====================
    // // Backup (Admin Only)
    // // =====================

    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/create', [BackupController::class, 'createBackup'])->name('backup.create');
    Route::get('/backup/download/{filename}', [BackupController::class, 'downloadBackup'])->name('backup.download');
    Route::delete('/backup/delete/{filename}', [BackupController::class, 'deleteBackup'])->name('backup.delete');
    Route::post('/backup/now', [BackupController::class, 'backupNow'])->name('backup.now');


    // Route::middleware('role:admin')->group(function () {
    //     Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    //     Route::get('/settings/timezone', [SettingController::class, 'timezone'])->name('timezone.settings');
    //     Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    // });

    // Roles route
    Route::resource('roles', RoleController::class);
    Route::patch('assign_role_to_user/{user}', [RoleController::class, 'assign_role_to_user'])->name('assign_role_to_user');
    Route::patch('sync_permissions_to_role/{role}', [RoleController::class, 'sync_permissions_to_role'])->name('sync_permissions_to_role');

});

// Authentication Routes
require __DIR__ . '/auth.php';
