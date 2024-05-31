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
        Schema::create('signed_voters', function (Blueprint $table) {
            $table->id();
            $table->text('voter');
            $table->string('scanner_in')->nullable(); //the user that scanned the voter
            $table->dateTime('scan_in')->nullable();
            $table->string('scanner_out')->nullable();
            $table->dateTime('scan_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signed_voters');
    }
};
