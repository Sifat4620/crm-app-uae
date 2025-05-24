<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductAndOrderManagementTables extends Migration
{
    public function up()
    {
        // Disable foreign key checks to avoid issues while dropping tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Create clients table first to avoid foreign key constraint issues
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('phone')->nullable();
            $table->string('business_name')->nullable();
            $table->string('vat_no')->nullable();
            $table->string('tax_no')->nullable();
            $table->string('national_id')->nullable();
            $table->string('business_number')->nullable();
            $table->string('tel')->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('area')->nullable();
            $table->string('house')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('vibre')->nullable();
            $table->string('imo')->nullable();
            $table->string('website')->nullable();
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        // Create product categories table
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Create products table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity');
            $table->timestamps();
        });

        // Create new product requests table
        Schema::create('new_product_requests', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('requested_by');
            $table->text('reason')->nullable();
            $table->timestamps();
        });

        // Create orders table after clients table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('billing_cycle_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['active', 'processing', 'pending', 'canceled', 'terminated', 'fraud'])->default('pending')->nullable();
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });

        // Create order statuses table (optional, if you need more details about statuses)
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name');
            $table->timestamps();
        });

        // Create product stock counts table
        Schema::create('product_stock_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->integer('stock_count');
            $table->timestamps();
        });

        // Create billing cycles table
        Schema::create('billing_cycles', function (Blueprint $table) {
            $table->id();
            $table->string('cycle_name');
            $table->integer('duration_in_days');
            $table->timestamps();
        });

        // Create order_billing_cycles pivot table to associate orders with billing cycles
        Schema::create('order_billing_cycle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('billing_cycle_id')->constrained('billing_cycles');
            $table->timestamps();
        });

        // Re-enable foreign key checks after migrations are complete
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down()
    {
        // Disable foreign key checks before dropping tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('order_billing_cycle');
        Schema::dropIfExists('billing_cycles');
        Schema::dropIfExists('product_stock_counts');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('new_product_requests');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('clients');

        // Re-enable foreign key checks after dropping tables
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
