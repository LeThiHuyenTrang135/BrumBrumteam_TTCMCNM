<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('product_images')
            ->where('path', 'NOT LIKE', 'products/%')
            ->update([
                'path' => DB::raw("CONCAT('products/', path)")
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('product_images')
            ->where('path', 'LIKE', 'products/%')
            ->update([
                'path' => DB::raw("SUBSTRING(path, 10)")
            ]);
    }
};
