<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Локації
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->geometry('coordinates', subtype: 'point')->nullable();
            $table->string('phone')->nullable();
            $table->string('working_hours')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 2. Категорії
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon_url')->nullable();
            // Рекурсивний зв'язок (категорія в категорії)
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });

        // 3. Товари
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->decimal('price_uah', 10, 2);
            $table->integer('price_it_coins')->nullable();
            $table->integer('cashback_percent')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('tag')->nullable();
            $table->timestamps();
        });

        // 4. Акції
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->date('valid_until')->nullable();
            $table->timestamps();
        });

        // 5. Стрічка новин
        Schema::create('news_feed', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->enum('type', ['promo', 'event', 'info'])->default('info');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_feed');
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('locations');
    }
};
