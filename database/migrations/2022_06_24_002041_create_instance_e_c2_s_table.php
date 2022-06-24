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
        Schema::create('instance_e_c2_s', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('instance_id');
            $table->string('chat_id');
            $table->text('aws_access_key');
            $table->text('aws_secret_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instance_e_c2_s');
    }
};
