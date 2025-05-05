<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    UserController,
    ProductController,
    ProductCategoryController,
    OrderController,
    InvoiceController,
    PaymentController,
    TicketController,
    ReportController,
    ExpenseController,
    SettingController,
    BackupController
};

Route::middleware('auth')->group(function () {

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
    // Product Management
    // =====================
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); 
    Route::get('/products/categories', [ProductCategoryController::class, 'index'])->name('product.categories');

    // =====================
    // Order Management
    // =====================
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store'); 
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/status/{status}', [OrderController::class, 'status'])->name('orders.status');

    // =====================
    // Invoice & Payment System
    // =====================
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoice.store'); 
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

    // =====================
    // Support & Ticket System
    // =====================
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store'); 

    // =====================
    // Financial Reports & Expenses
    // =====================
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');

    // =====================
    // System Settings (Admin Only)
    // =====================
    Route::middleware('role:admin')->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/settings/timezone', [SettingController::class, 'timezone'])->name('timezone.settings');
        Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    });
});

// Authentication Routes
require __DIR__ . '/auth.php';
