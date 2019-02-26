<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrSubscriberFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_fields', function (Blueprint $table) {
            $table->unsignedInteger('subscriber_id');
            $table->unsignedInteger('field_id');
            $table->string('value');

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('cascade');;
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriber_fields');
    }
}
