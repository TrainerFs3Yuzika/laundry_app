<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_title');
            $table->text('website_description')->nullable();
            $table->string('timezone');
            $table->string('language');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            // Add tax field default 10%
            $table->string('tax')->default('10');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
