<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('customer_id');
            $table->decimal('price', 7, 2);
            $table->smallInteger('quantity');
            $table->timestamp('command_at');// pour faire le nbr de commandes du client
            $table->enum('status', ['finalized','unfinalized'])->default('finalized');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
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
        Schema::drop('histories');
    }
}
