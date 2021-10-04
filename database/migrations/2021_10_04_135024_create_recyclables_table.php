<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecyclablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recyclables', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('user_id');
            $table->UnsignedBigInteger('pet')->nullable(); 
            $table->UnsignedBigInteger('rigid_plastic')->nullable();
            $table->UnsignedBigInteger('glass')->nullable();
            $table->UnsignedBigInteger('paper')->nullable();
            $table->UnsignedBigInteger('aluminium')->nullable();
            $table->UnsignedBigInteger('oil')->nullable();
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
        Schema::dropIfExists('recyclables');
    }
}
