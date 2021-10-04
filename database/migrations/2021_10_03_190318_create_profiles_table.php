<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id(); 
            $table->UnsignedBigInteger('user_id');
            $table->text('office_name')->nullable();
            $table->string('address')->nullable();
            $table->json('order')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->boolean('activated')->default(false);
            $table->json('pickup_date')->nullable();
            $table->string('image')->default('office.webp');
            $table->UnsignedBigInteger('contract')->nullable();
            $table->timestamp('delivered_at')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
