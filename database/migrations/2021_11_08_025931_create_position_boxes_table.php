<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Webpatser\Uuid\Uuid;

class CreatePositionBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_box', function (Blueprint $table) {
            $table->uuid("id")->unique()->default((string) Uuid::generate(4));
            $table->integer("box_rows")->default(1);
            $table->integer("box_columns")->default(1);
            $table->json("box_disable_rows")->nullable();
            $table->json("box_disable_columns")->nullabe();
            $table->boolean("visibility")->default(true);
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->uuid('updated_by')->nullable();
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
        Schema::dropIfExists('position_boxes');
    }
}
