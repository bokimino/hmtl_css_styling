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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
            $table->dropColumn('product_category_id');
            $table->dropForeign(['products_tags_id']);
            $table->dropColumn('products_tags_id');

            $table->string('material')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->unsignedBigInteger('products_tags_id');
            $table->foreign('products_tags_id')->references('id')->on('product_tags');
        
            $table->string('material')->nullable(false)->change();
        });
    }
};
