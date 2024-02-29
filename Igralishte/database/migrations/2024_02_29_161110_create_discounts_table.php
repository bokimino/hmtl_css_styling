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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->integer('discount')->unsigned();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('discount_category_id');
            $table->timestamps();

            
            $table->foreign('discount_category_id')->references('id')->on('discount_categories');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
