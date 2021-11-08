<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Webpatser\Uuid\Uuid;

class CreatePositionBoxContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_box_contents', function (Blueprint $table) {
            $table->uuid("id")->unique()->default((string) Uuid::generate(4));
            $table->uuid('position_box_id');
            $table->foreign('position_box_id')->references('id')->on('position_box');
            $table->uuid('position_box_text_id')->unique();
            $table->foreign('position_box_text_id')->references('id')->on('position_box_texts');
            $table->json("position");
            $table->longText("css_styling_code")->nullable();
            $table->string("text_color")->nullable();
            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->uuid('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('position_box_contents');
    }
}
