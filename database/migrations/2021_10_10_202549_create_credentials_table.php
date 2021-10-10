<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('user_id');
            $table->string('registre')->nullable();
            $table->string('nif')->nullable();
            $table->string('nis')->nullable();
            $table->string('rip')->nullable();
            $table->string('invoice_number')->nullable();
            $table->timestamp('to_be_delivered_at')->nullable();
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
        Schema::dropIfExists('credentials');
    }
}
