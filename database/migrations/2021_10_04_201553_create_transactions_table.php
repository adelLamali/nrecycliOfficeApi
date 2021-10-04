<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('user_id');
            $table->UnsignedBigInteger('pet')->default(0);
            $table->UnsignedBigInteger('rigid_plastic')->default(0);
            $table->UnsignedBigInteger('glass')->default(0);
            $table->UnsignedBigInteger('paper')->default(0);
            $table->UnsignedBigInteger('aluminium')->default(0);
            $table->UnsignedBigInteger('oil')->default(0);
            $table->UnsignedBigInteger('rate')->default(0);
            $table->string('destination')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
