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
        Schema::table('building_permit_forms', function (Blueprint $table) {
            $table->integer('application_form_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('building_permit_forms', function (Blueprint $table) {
            $table->dropColumn('application_form_id');
        });
    }
};
