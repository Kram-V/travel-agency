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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('featured_photo')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->string('country');
            $table->text('visa_requirement');
            $table->string('language');
            $table->string('currency');
            $table->string('area');
            $table->string('timezone');
            $table->string('best_time');
            $table->text('health_and_safety');
            $table->integer('view_count')->default(0);
            $table->text('map');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
