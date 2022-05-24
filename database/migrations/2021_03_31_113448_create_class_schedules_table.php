<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('module')->nullable()->comment('1 = spinning cycle, 2 = personal training, 3 = group class');
            $table->integer('class_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('weekday')->nullable()->comment('0 = sunday');
            $table->integer('num_seats')->nullable();
            $table->integer('coach_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('booking_type')->nullable()->comment('1 = private, 2= public');
            $table->integer('cancelled_by')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_schedules');
    }
}
