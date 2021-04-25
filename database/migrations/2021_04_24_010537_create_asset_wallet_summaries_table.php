<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetWalletSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_asset_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_wallet_id');
            $table->date('date');
            $table->double('amount');
            $table->double('avg_price');
            $table->double('result');
            $table->timestamps();

            $table->foreign('asset_wallet_id')
                ->references('id')
                ->on('asset_wallet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_asset_summaries');
    }
}
