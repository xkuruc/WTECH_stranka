<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        // Users
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // Vlastný primárny kľúč
            $table->string('meno');
            $table->string('priezvisko');
            $table->string('email')->unique(); // Unikátna emailová adresa
            $table->string('password'); // Heslo
            $table->string('telephone')->nullable();

            $table->string('pohlavie')->nullable(); // Muž / Žena
            $table->boolean('newsletter')->default(false); // 1 = áno, 0 = nie
            $table->date('datum_narodenia')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->date('registration_date');
            $table->timestamps(); // created_at a updated_at
        });


        // Vytvorenie tabuľky pre resetovanie hesla
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Primárny kľúč je email
            $table->string('token'); // Token pre reset hesla
            $table->timestamp('created_at')->nullable(); // Dátum vytvorenia tokenu
        });

        // Vytvorenie tabuľky pre sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Primárny kľúč pre session ID
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable(); // IP adresa používateľa (nepovinná)
            $table->text('user_agent')->nullable(); // User agent (nepovinný)
            $table->longText('payload'); // Údaje uložené v session
            $table->integer('last_activity')->index(); // Posledná aktivita
        });


        // Addresses
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('address_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->enum('address_type', ['billing', 'shipping']);
            $table->string('ulica');
            $table->string('mesto');
            $table->integer('psc');
            $table->string('krajina');
            $table->string('cisloDomu');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });


        // Personalizácia
        Schema::create('personalizacia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('vyska')->nullable();
            $table->string('hmotnost')->nullable();
            $table->string('velkost_topanok')->nullable();
            $table->string('znacka')->nullable();
            $table->timestamps();
        });


        // Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_category_id')->nullable();
            $table->foreign('parent_category_id')->references('category_id')->on('categories')->nullOnDelete();
            $table->timestamps();
        });

        // Products
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 5, 2)->default(0);
            $table->string('SKU')->unique();
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('cascade');
            $table->integer('stock_quantity');
            $table->string('brand')->nullable();
            $table->timestamps();
        });

        // Product Images
        Schema::create('product_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->string('image_url');
            $table->string('alt_text')->nullable();
            $table->timestamps();
        });

        // Product Reviews
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->date('review_date');
            $table->timestamps();
        });

        // Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('billing_address_id')->constrained('addresses', 'address_id');
            $table->foreignId('shipping_address_id')->constrained('addresses', 'address_id');
            $table->date('order_date');
            $table->string('status');
            $table->decimal('total_amount', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Order Items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('discount', 5, 2)->default(0);
            $table->timestamps();
        });

        // Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade');
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });

        // Shippings
        Schema::create('shippings', function (Blueprint $table) {
            $table->id('shipping_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade');
            $table->string('shipping_method');
            $table->date('shipped_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('carrier')->nullable();
            $table->timestamps();
        });

        // Promotions
        Schema::create('promotions', function (Blueprint $table) {
            $table->id('promotion_id');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->decimal('discount_percentage', 5, 2);
            $table->date('valid_from');
            $table->date('valid_to');
            $table->integer('usage_limit');
            $table->timestamps();
        });

        // Promotion Usages
        Schema::create('promotion_usages', function (Blueprint $table) {
            $table->id('usage_id');
            $table->foreignId('promotion_id')->constrained('promotions', 'promotion_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade');
            $table->timestamp('used_at');
            $table->timestamps();
        });

        // Shopping Carts
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->timestamps();
        });

        // Cart Items
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('cart_item_id');
            $table->foreignId('cart_id')->constrained('shopping_carts', 'cart_id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Poradie mazania závisí od cudzích kľúčov - najprv závislé tabuľky
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('shopping_carts');
        Schema::dropIfExists('promotion_usages');
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('shippings');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('personalizacia');
        Schema::dropIfExists('users');
    }
};
