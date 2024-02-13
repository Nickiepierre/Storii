<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->text('email');
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('isUnsubscribed')->default(0);
            $table->unique([DB::raw('email(255)')]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('emails');
    }
};
