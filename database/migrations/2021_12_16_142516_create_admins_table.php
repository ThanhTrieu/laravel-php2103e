<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tao bang du lieu - sau nay chay lenh se dc import vao database
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // bigint - unsigned - auto increment
            // tao cac truong trong bang
            $table->string('username',60)->unique(); // unique: ko trung du lieu
            $table->string('password', 60);
            $table->string('email',120)->unique();
            $table->string('phone',20);
            $table->string('address',200);
            $table->date('birthday')->nullable(); // nullable: khong bat buoc nhap du lieu
            $table->string('avatar')->nullable(); // nullable:
            $table->text('description')->nullable(); //
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('gender')->default(0);
            $table->datetime('last_login')->nullable();
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
