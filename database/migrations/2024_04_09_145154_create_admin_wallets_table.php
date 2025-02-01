<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_wallets', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('btc')->default('wallet address here');
            $table->string('eth')->default('wallet address here');
            $table->longText('usdt')->default('wallet address here');
            $table->longText('cash_app')->default('wallet address here');
            $table->longText('paypal')->default('wallet address here');
            $table->longText('zelle')->default('wallet address here');
            $table->longText('bnb')->default('wallet address here');
            $table->longText('bch')->default('wallet address here');
            $table->longText('ltc')->default('wallet address here');
            $table->longText('xrp')->default('wallet address here');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_wallets');
    }
};
