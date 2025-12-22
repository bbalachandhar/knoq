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
            $table->string('visa_issued_country')->nullable()->after('passport_expiry_date');
            $table->date('visa_issued_on')->nullable()->after('visa_issued_country');
            $table->date('visa_expiry_date')->nullable()->after('visa_issued_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['visa_issued_country', 'visa_issued_on', 'visa_expiry_date']);
        });
    }
};
