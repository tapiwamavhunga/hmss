<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_payrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('sr_no');
            $table->string('payroll_id');
            $table->integer('type');
            $table->integer('owner_id');
            $table->string('owner_type');
            $table->string('month');
            $table->integer('year');
            $table->double('net_salary');
            $table->integer('status');
            $table->double('basic_salary');
            $table->double('allowance');
            $table->double('deductions');
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('employee_payrolls');
    }
};
