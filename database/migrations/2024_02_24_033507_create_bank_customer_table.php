<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bank_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 300);
            $table->string('email', 300);
            $table->string('password', 300);
            $table->decimal('balance', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bank_customer');
    }
};
