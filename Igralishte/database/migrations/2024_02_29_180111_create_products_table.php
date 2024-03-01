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
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->boolean('is_active')->default(true);
            $table->text('size_description')->nullable();
            $table->string('material');
            $table->string('maintenance');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('products_tags_id')->nullable();
            $table->unsignedBigInteger('accessories_id')->nullable();
            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('products_tags_id')->references('id')->on('product_tags');
            $table->foreign('accessories_id')->references('id')->on('accessories');

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
