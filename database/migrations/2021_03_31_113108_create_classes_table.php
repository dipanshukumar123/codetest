<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('module')->nullable()->comment('1 = spinning cycle, 2 = personal training, 3 = group class');
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('num_seats')->nullable();
            $table->decimal('seat_price',10,3)->nullable();
            $table->decimal('floor_price',10,3)->nullable();
            $table->integer('duration')->nullable();
            $table->string('duration_label')->nullable();
            $table->tinyInteger('app_visibility')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('classes');
    }
}
