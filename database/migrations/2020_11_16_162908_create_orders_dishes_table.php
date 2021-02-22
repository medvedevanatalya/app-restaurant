<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_dishes', function (Blueprint $table) {
            $table->id();

            // внешний ключ, ссылается на поле id таблицы orders
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            // внешний ключ, ссылается на поле id таблицы dishes
            $table->unsignedBigInteger('dish_id');
            $table->foreign('dish_id')
                ->references('id')
                ->on('dishes')
                ->onDelete('cascade');

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
        Schema::dropIfExists('orders_dishes');
    }
}
