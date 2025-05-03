<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('Dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/register', [UserController::class, 'create'])->name('user.register');
    Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');

    // =====================
    // Product & Order Management
    // =====================
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/categories', [ProductCategoryController::class, 'index'])->name('product.categories');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/status/{status}', [OrderController::class, 'status'])->name('orders.status');

    // =====================
    // Invoice & Payment System
    // =====================
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

    // =====================
    // Support & Ticket System
    // =====================
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');

    // =====================
    // Financial Reports & Settings
    // =====================
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');

    // =====================
    // System Settings (Admin Only)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/timezone', [SettingController::class, 'timezone'])->name('timezone.settings');
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');

});


require __DIR__ . '/auth.php';
