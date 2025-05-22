<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Backup\BackupController;
use App\Http\Controllers\Support\TicketController;
// use App\Http\Controllers\Billing\PaymentController;
use App\Http\Controllers\Billing\InvoiceController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductCategoryController;
use App\Http\Controllers\Billing\BillingCycleController;


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

    // // =====================
    // // Client Management
    // // =====================
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Route::get('/users/register', [UserController::class, 'create'])->name('user.register');
    // Route::post('/users/register', [UserController::class, 'store'])->name('user.store'); 
    // Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');




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
    Route::prefix('orders')->name('orders.')->group(function () {
        // Show all orders
        Route::get('/', [OrderController::class, 'index'])->name('index');

        // Create a new order (show form)
        Route::get('/create', [OrderController::class, 'create'])->name('create');

        // Store a new order (submit form)
        Route::post('/', [OrderController::class, 'store'])->name('store');

        // Show a specific order by ID
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');

        // Update the status of an order
        Route::get('/status/{status}', [OrderController::class, 'status'])->name('status');

        // Track the order
        Route::get('/track/{id}', [OrderController::class, 'trackOrder'])->name('track');

        // Update the status of a specific order
        Route::put('/{id}/update-status', [OrderController::class, 'updateStatus'])->name('update-status');

        // Client-Wise Products
        Route::get('/client/{clientId}/products', [OrderController::class, 'clientProducts'])->name('client-products');

        // Product Stock & Order Processing Time
        Route::get('/product/{productId}/check-stock', [OrderController::class, 'checkStock'])->name('check-stock');

        // // Billing Cycle Options
        // Route::get('/billing-options', [OrderController::class, 'billingOptions'])->name('billing-options');
    });

    // =====================
    // Billing Cycle Options
    // =====================
    Route::prefix('billing-cycles')->name('billing-cycles.')->group(function () {
        Route::get('/', [BillingCycleController::class, 'index'])->name('index');
        Route::get('/create', [BillingCycleController::class, 'create'])->name('create');
        Route::post('/', [BillingCycleController::class, 'store'])->name('store');
        Route::get('/{billingCycle}/edit', [BillingCycleController::class, 'edit'])->name('edit');
        Route::put('/{billingCycle}', [BillingCycleController::class, 'update'])->name('update');
        Route::delete('/{billingCycle}', [BillingCycleController::class, 'destroy'])->name('destroy');
    });

    

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
        });


        // // Payment Routes
        // Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');   // View all payments
        // Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');   // View a single payment
        // Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');   // Record a new payment
        // Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');   // Create a payment entry

        // // Additional Routes for Invoice Status Management
        // Route::get('/invoices/status/{status}', [InvoiceController::class, 'filterByStatus'])->name('invoice.filterByStatus');   // Filter invoices by status (e.g., Paid, Due, Overdue)

        // // Reports Routes
        // Route::get('/payments/report', [PaymentController::class, 'generateReport'])->name('payments.report');   // Generate payment report
        // Route::get('/invoices/report', [InvoiceController::class, 'generateReport'])->name('invoices.report');   // Generate invoice report






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
