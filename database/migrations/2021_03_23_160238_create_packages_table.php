<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('module')->nullable()->comment('1 = spinning cycle, 2 = personal training, 3 = group class');
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('num_classes')->nullable();
            $table->decimal('price',10,3)->nullable();
            $table->integer('validity')->nullable()->comment('in days');
            $table->string('validity_label')->nullable();
            $table->tinyInteger('app_visibility')->nullable();
            $table->integer('sort_order')->default('0')->comment('highest on top');
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
        Schema::dropIfExists('packages');
    }
}
