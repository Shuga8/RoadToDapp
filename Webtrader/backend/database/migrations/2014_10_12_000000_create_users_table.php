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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->longText("balance")->default('{"BTC":0,"DOGE":0,"ETH":0,"SOL":0,"USD":0,"USDT":0}');
            $table->longText("avater")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('two_fa')->default(false);
            $table->integer('two_fa_code')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
