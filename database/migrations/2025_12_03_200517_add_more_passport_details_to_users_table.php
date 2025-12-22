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
        Schema::table('users', function (Blueprint $table) {
            $table->string('passport_number')->nullable()->after('passport_expiry_date');
            $table->string('place_of_issue')->nullable()->after('passport_number');
            $table->string('nationality')->nullable()->after('place_of_issue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['passport_number', 'place_of_issue', 'nationality']);
        });
    }
};