<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('market_id');
            $table->string('pair');
            $table->float('price');
            $table->dateTime('price_at');
            $table->float('volume');
            $table->float('max_price');
            $table->float('min_price');
            $table->timestamps();

            $table->foreign('asset_id')
                ->references('id')
                ->on('assets');

            $table->foreign('market_id')
                ->references('id')
                ->on('markets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_summaries');
    }
}
