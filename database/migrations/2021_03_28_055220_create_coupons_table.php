<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('module')->nullable()->comment('1 = spinning cycle, 2 = personal training, 3 = group class');
            $table->tinyInteger('type')->nullable()->comment('1 = package, 2 = class, 3 = event');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->tinyInteger('discount_type')->nullable()->comment('1 = fix, 2 = percentage');
            $table->decimal('discount', 10, 3)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('total_usage')->nullable();
            $table->integer('usage_per_user')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
