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
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('uuid', 36)->unique();
            $table->unsignedBigInteger('toko_id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('address');
            $table->string('photo')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('type')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier');
    }
};
