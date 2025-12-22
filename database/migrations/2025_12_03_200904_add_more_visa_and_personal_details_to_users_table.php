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
            $table->string('visa_brp_number')->nullable()->after('visa_expiry_date');
            $table->string('share_code')->nullable()->after('visa_brp_number');
            $table->string('national_insurance_number')->nullable()->after('share_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['visa_brp_number', 'share_code', 'national_insurance_number']);
        });
    }
};