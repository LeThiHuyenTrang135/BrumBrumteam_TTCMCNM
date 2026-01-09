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
        if (!Schema::hasColumn('users', 'verification_code')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('verification_code', 6)->nullable();
                $table->timestamp('code_expires_at')->nullable();
                $table->boolean('is_verified')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['verification_code', 'code_expires_at', 'is_verified']);
        });
    }
};
