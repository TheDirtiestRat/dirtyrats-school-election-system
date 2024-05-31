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
        Schema::create('registered_voters', function (Blueprint $table) {
            $table->id();
            $table->text('voter_id');
            $table->text('usn_or_lrn');
            $table->string('first_name')->collation('utf8mb4_general_ci')->charset('utf8mb4');
            $table->string('mid_name')->nullable();
            $table->string('last_name')->collation('utf8mb4_general_ci')->charset('utf8mb4');
            $table->string('strand_or_course');
            $table->string('school_level');
            $table->string('year');
            $table->string('section');
            $table->string('house')->nullable();
            $table->text('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_voters');
    }
};
