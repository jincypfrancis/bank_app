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
        Schema::create('bank_transfer', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('customerid');
        $table->string('email', 300);
        $table->integer('transfered_customer');
        $table->string('transfered_email', 300);
        $table->date('transdate');
        $table->decimal('amount', 12, 2);
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
        Schema::dropIfExists('bank_transfer');
    }
};
