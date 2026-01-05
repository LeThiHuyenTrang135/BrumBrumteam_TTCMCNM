<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('shoppingcart')) {
            Schema::create('shoppingcart', function (Blueprint $table) {
                $table->string('identifier');
                $table->string('instance');
                $table->longText('content');
                $table->nullableTimestamps();
                $table->primary(['identifier', 'instance']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('shoppingcart');
    }
};