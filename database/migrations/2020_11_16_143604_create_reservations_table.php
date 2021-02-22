<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // внешний ключ, ссылается на поле id таблицы clients
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            // внешний ключ, ссылается на поле id таблицы tables
            $table->unsignedBigInteger('table_id');
            $table->foreign('table_id')
                ->references('id')
                ->on('tables')
                ->onDelete('cascade');

            $table->dateTime('date_time_order')->useCurrent();
            $table->dateTime('date_time_which_order_placed')->nullable();

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
        Schema::dropIfExists('reservations');
    }
}
