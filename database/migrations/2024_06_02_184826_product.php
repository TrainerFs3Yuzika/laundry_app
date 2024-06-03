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
            $table->string('name_product');
            $table->string('description');
            $table->number('price');
            $table->string('image');
            $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('brand_id');
            $table->string('status')->default('active'); // Memberikan nilai default untuk status
            $table->decimal('tax', 8, 2)->default(0.00); // Memberikan nilai default untuk tax
            $table->decimal('discount', 8, 2)->default(0.00); // Memberikan nilai default untuk discount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
