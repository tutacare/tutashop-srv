<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('upc_ean_isbn',90);
            $table->string('item_name',90);
            $table->string('size',20);
            $table->text('description');
            $table->decimal('cost_price',9, 2);
            $table->decimal('selling_price',9, 2);
            $table->integer('quantity');
            $table->string('avatar', 100)->default('no-foto.png');
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
        Schema::dropIfExists('items');
    }
}
