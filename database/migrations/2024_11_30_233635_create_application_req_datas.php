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
        Schema::create('application_req_datas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('application_id')->constrained('application_forms')->cascadeOnDelete();
            $table->foreignId('requirement_id')->constrained('requirements')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->string('key', 100)->nullable();
            $table->string('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_req_datas');
    }
};
