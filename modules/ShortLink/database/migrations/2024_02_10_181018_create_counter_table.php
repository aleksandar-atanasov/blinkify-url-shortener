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
        Schema::create('counter', function (Blueprint $table) {
            $table->snowflake()->primary();
            $table->unsignedBigInteger('value');
            $table->timestamps();
        });

        DB::table('counter')->insert([
            'id' => snowflake(),
            'value' => config('app.counter', 100000000000)
        ]);
    }
};
