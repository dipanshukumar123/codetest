<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->nullable()->comment('1 = admin, 2 = coach, 3 = member, 4 = guest');
            $table->tinyInteger('coach_type')->nullable()->comment('1 = full time, 2 = part time, 3 = freelancer');
            $table->string('civil_id_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('mobile')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('1 = male, 2 = female');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('coach_application_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
