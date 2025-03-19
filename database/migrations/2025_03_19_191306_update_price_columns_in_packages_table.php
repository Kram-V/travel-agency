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
        Schema::table('packages', function (Blueprint $table) {
          Schema::table('packages', function (Blueprint $table) {
              $table->dropColumn(['price', 'old_price']);
          });

          Schema::table('packages', function (Blueprint $table) {
              $table->integer('price')->after('map');
              $table->integer('old_price')->nullable()->after('price');
          });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('packages', function (Blueprint $table) {
          $table->dropColumn(['price', 'old_price']);
      });

      Schema::table('packages', function (Blueprint $table) {
          $table->decimal('price', 10, 2)->unsigned()->after('map');
          $table->decimal('old_price', 10, 2)->unsigned()->after('price');
      });
    }
};
