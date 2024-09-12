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
        Schema::table('ipd_patient_departments', function (Blueprint $table) {
            $table->boolean('is_discharge')->nullable()->default(false)->after('admission_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ipd_patient_departments', function (Blueprint $table) {
            $table->dropColumn('is_discharge');
        });
    }
};
