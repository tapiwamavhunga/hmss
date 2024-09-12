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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('submenu')->nullable()->default(0);
            $table->text('route');
            $table->integer('has_parent')->nullable()->default(0);
            $table->integer('is_default')->nullable()->default(0);
            $table->timestamps();

            $table->index(['name', 'submenu', 'has_parent', 'is_default']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
