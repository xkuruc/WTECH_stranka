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

        /* farby */
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Názov farby (Červená, Modrá, ...)
            $table->string('sklon_name'); /* pre sklonovanie */
            $table->string('hex'); // Hex kód alebo linear gradient
            $table->timestamps();
        });


        // create_categories_table.php
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // create_season_table.php
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });



        // create_suppliers_table.php
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });


        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // pre URL a interné spracovanie (napr. nike)
            $table->string('display_name');  // pre zobrazenie (napr. Nike)
            $table->timestamps();
        });


        // Products
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // Primárny kľúč (bigIncrements od Laravel 7+ skrýva $table->bigIncrements('id'))
            $table->string('name');  // Názov produktu
            $table->text('description')->nullable();   // Podrobný popis (môže byť prázdny)
            $table->decimal('price', 8, 2);  // Základná cena s dvoma desatinnými miestami
            $table->decimal('discount', 8, 2)->default(0);  // Zľava (napr. 0.00 ak bez zľavy)
            $table->string('SKU')->unique();  // Unikátny kód produktu
            // Vzťahy na kategóriu a dodávateľa, s kaskádnym mazaním
            $table->foreignId('supplier_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->unsignedInteger('stock_quantity')->default(0);   // Počet kusov na sklade
            $table->timestamps();  // timestampy created_at a updated_at
            $table->text('main_image')->nullable();
            $table->string('available');
            $table->string('gender');
            $table->string('type'); //tenisky, kopačky, lopty
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade'); //leto, zima, jar, ...
            $table->foreignId('color_id')
                ->constrained('colors') // Odkazuje na tabuľku colors
                ->onDelete('set null');
            $table->foreignId('brand_id')
                ->constrained('brands')
                ->onDelete('set null'); /* brand */
            $table->text('search_vector')->nullable(); /* pre full-text */
        });


        /* obrázky produktov */
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained()           // references 'id' on 'products'
                  ->onDelete('cascade');
            // cesta k obrázku
            $table->string('image_path');
            $table->timestamps();
        });


        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            // US veľkosť (napr. 6.5, 7, 8.5...)
            $table->decimal('us_velkost', 5, 2);
            // Počet kusov v danej veľkosti
            $table->unsignedInteger('pocet')->default(0);
            $table->timestamps();
        });


        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->string('session_id')->nullable();

            // tu pridáme index a FK na sessions.id
            $table->string('session_id')->nullable()->index();
            $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');  // ak sa zmaže produkt, položka sa vymaže
            $table->unsignedInteger('quantity')->default(1); // počet kusov
            $table->string('size')->after('quantity');
        });




        /* full text vyhladavanie */
        // Vytvoríme GIN index pre efektívne vyhľadávanie


        // Naplníme existujúce produkty dátami
        DB::statement("
            UPDATE products
            SET search_vector = to_tsvector('simple', coalesce(products.name, '') || ' ' ||
                                                 coalesce(products.description, '') || ' ' ||
                                                 coalesce(products.gender, '') || ' ' ||
                                                 coalesce((SELECT display_name FROM brands WHERE brands.id = products.brand_id), '') || ' ' ||
                                                 coalesce(brands.name, '') || ' ' ||
                                                 coalesce(colors.name, '') || ' ' ||
                                                 coalesce(seasons.name, '') || ' ' ||  -- Pridáme season (názov sezóny)
                                                 coalesce(products.type, '')         -- Pridáme type (string)
            )
            FROM brands, colors, seasons
            WHERE products.brand_id = brands.id
            AND products.color_id = colors.id
            AND products.season_id = seasons.id;
        ");

        DB::statement('CREATE INDEX products_search_vector_index ON products USING GIN (search_vector gin_trgm_ops)');
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
        Schema::dropIfExists('colors');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');

        DB::statement('DROP INDEX IF EXISTS products_search_vector_index');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('search_vector');
        });

        Schema::dropIfExists('categories');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('personalizacia');
        Schema::dropIfExists('users');
    }
};
