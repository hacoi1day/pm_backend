<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('type');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('phone')->nullable(true);
            $table->string('cause')->nullable(true);
            $table->string('project')->nullable(true);
            $table->string('approval_by')->nullable(true);
            $table->tinyInteger('status')->nullable(true);
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
        Schema::dropIfExists('requests');
    }
}
