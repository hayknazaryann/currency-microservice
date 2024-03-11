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
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')
                ->constrained('currency_requests')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('num_code');
            $table->string('char_code');
            $table->string('units');
            $table->float('rate', 8, 4);
            $table->float('inverse_rate', 8, 5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
    }
};
