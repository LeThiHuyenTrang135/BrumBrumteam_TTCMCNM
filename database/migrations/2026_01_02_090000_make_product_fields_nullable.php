<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeProductFieldsNullable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned()->nullable()->change();
            $table->integer('product_category_id')->unsigned()->nullable()->change();
            $table->boolean('featured')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned()->change();
            $table->integer('product_category_id')->unsigned()->change();
            $table->boolean('featured')->change();
        });
    }
}
