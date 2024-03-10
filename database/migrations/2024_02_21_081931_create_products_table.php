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
            $table->uuid('uuid')->index();
            $table->string('name')->unique();
            $table->string('slug')->nullable();
            $table->decimal('price', 8, 2);
            $table->text('description');
            // $table->unsignedBigInteger('category_id');
            $table->foreignId('category_id')->constrained();
            // $table->unsignedBigInteger('brand_id');
            $table->foreignId('brand_id')->constrained();
            $table->unsignedInteger('status')->default(0);
            $table->string('cover');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
