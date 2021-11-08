<?php

use App\Models\PositionBoxText;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Webpatser\Uuid\Uuid;

class CreatePositionBoxTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_box_texts', function (Blueprint $table) {
            $table->uuid("id")->unique()->default((string) Uuid::generate(4));
            $table->string("sentence")->unique();
            $table->timestamps();
        });


        $arr = [
            "Dropee.com",
            "B2B Marketplace",
            "SaaS enabled marketplace",
            "Provide Transparency",
            "Build Trust"
        ];

        foreach ($arr as $ar) {
            PositionBoxText::firstOrCreate(["sentence" => $ar]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position_box_texts');
    }
}
