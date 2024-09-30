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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('uuid', 36)->unique();
            $table->unsignedBigInteger('toko_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->integer('quantity');
            $table->integer('buying_price');
            $table->integer('selling_price');
            $table->integer('quantity_alert')->default(0);
            $table->integer('tax')->nullable();
            $table->text('notes')->nullable();
            $table->string('image')->nullable();
            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }};
