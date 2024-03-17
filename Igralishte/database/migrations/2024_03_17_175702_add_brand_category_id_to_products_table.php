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
            $table->unsignedBigInteger('brand_category_id')->nullable()->after('brand_id');
            $table->foreign('brand_category_id')
                ->references('id')
                ->on('brand_categories')
                ->onDelete('set null'); 
            ;
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_category_id']);
            $table->dropColumn('brand_category_id');
         
         
        });
    }
};
