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
        Schema::create('short_links', function (Blueprint $table) {
            $table->snowflake()->primary();
            $table->unsignedBigInteger('counter')->index('short_links_counter_index');
            $table->string('short_url')->unique();
            $table->string('original_url');
            $table->string('domain');
            $table->string('custom_url', 16)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }
};
