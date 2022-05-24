<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('working_days')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('version')->nullable();
            $table->tinyInteger('min_slot_duration')->nullable();
            $table->tinyInteger('m1_num_seats')->nullable();
            $table->decimal('m1_seat_price',10,3)->nullable();
            $table->decimal('m1_floor_price',10,3)->nullable();
            $table->decimal('m1_commission',10,3)->nullable();
            $table->tinyInteger('m1_booking_offset')->nullable();
            $table->tinyInteger('m1_cancellation_offset')->nullable();
            $table->tinyInteger('m1_reminder_notification_offset')->nullable();
            $table->decimal('m2_individual_price',10,3)->nullable();
            $table->decimal('m2_couple_price',10,3)->nullable();
            $table->decimal('m2_coach_individual_price',10,3)->nullable();
            $table->decimal('m2_coach_couple_price',10,3)->nullable();
            $table->tinyInteger('m2_num_classes_per_slot')->nullable();
            $table->tinyInteger('m2_booking_offset')->nullable();
            $table->tinyInteger('m2_cancellation_offset')->nullable();
            $table->tinyInteger('m2_reminder_notification_offset')->nullable();
            $table->decimal('m3_seat_price',10,3)->nullable();
            $table->decimal('m3_floor_price',10,3)->nullable();
            $table->decimal('m3_commission',10,3)->nullable();
            $table->tinyInteger('m3_booking_offset')->nullable();
            $table->tinyInteger('m3_cancellation_offset')->nullable();
            $table->tinyInteger('m3_reminder_notification_offset')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
