<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_wallet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('wallet_id');
            $table->double('amount')
                ->default(0);
            $table->double('avg_price')
                ->default(0);
            $table->timestamps();

            $table->unique(['asset_id', 'wallet_id']);

            $table->foreign('asset_id')
                ->references('id')
                ->on('assets');

            $table->foreign('wallet_id')
                ->references('id')
                ->on('wallets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_wallet');
    }
}
