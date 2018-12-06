<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->integer('task_id')->unsigned()->index();
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('time_period');
            $table->integer('day');
            $table->string('occurrence')->nullable();
            $table->integer('slot');
            $table->timestamps();

            $table->foreign('group_id')
            ->references('id')
            ->on('groups')
            ->onDelete('cascade');

            $table->foreign('task_id')
            ->references('id')
            ->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slots');
    }
}
