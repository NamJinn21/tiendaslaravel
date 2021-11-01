<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('type_transaction');
            $table->string('description_transaction');
            $table->bigInteger('id_product');
            $table->string('code');
            $table->string('name');
            $table->integer('quantity_stock');
            $table->integer('quantity_inventory');
            $table->date('due_date');
            $table->string('category');
            $table->string('description');
            $table->integer('id_user');
            $table->integer('min_supply_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
