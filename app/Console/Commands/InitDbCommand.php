<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class InitDbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create application tables without using Laravel migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database initialization...');

        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
            $this->info('Created "categories" table.');
        } else {
            $this->info('Table "categories" already exists.');
        }

        if (!Schema::hasTable('menu_items')) {
            Schema::create('menu_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
                $table->string('name');
                $table->text('description')->nullable();
                $table->decimal('price', 10, 2);
                $table->string('tag')->nullable();
                $table->decimal('vat', 5, 2)->default(0);
                $table->string('image_url')->nullable();
                $table->string('energy_value')->nullable();
                $table->text('ingredients')->nullable();
                $table->timestamps();
            });
            $this->info('Created "menu_items" table.');
        } else {
            $this->info('Table "menu_items" already exists.');
        }

        if (!Schema::hasTable('news')) {
            Schema::create('news', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->date('start_date');
                $table->date('end_date')->nullable();
                $table->string('image_url')->nullable();
                $table->timestamps();
            });
            $this->info('Created "news" table.');
        } else {
            $this->info('Table "news" already exists.');
        }

        if (!Schema::hasTable('promos')) {
            Schema::create('promos', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->integer('discount_percent')->default(0);
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->string('image_url')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
            $this->info('Created "promos" table.');
        } else {
            $this->info('Table "promos" already exists.');
        }

        $this->info('Database initialization completed successfully!');
    }
}
