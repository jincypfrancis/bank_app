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
        Schema::create('bank_transaction', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('customerid');
        $table->string('email', 300);
        $table->string('transactiontype', 300);
        $table->string('type', 10);
        $table->decimal('amount', 12, 2);
        $table->decimal('balanceafter', 12, 2);
        $table->datetime('transdate');
        $table->string('remarks', 500);
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
        Schema::dropIfExists('bank_transaction');
    }
};
