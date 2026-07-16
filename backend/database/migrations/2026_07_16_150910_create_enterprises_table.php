<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enterprises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('state', 2);
            $table->decimal('total_value', 15, 2);
            $table->unsignedInteger('units_quantity');
            $table->decimal('unit_value', 15, 2);
            $table->enum('status', ['launching', 'under_construction', 'delivered'])->default('launching');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enterprises');
    }
};
