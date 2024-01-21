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
            $table->id();
            $table->string('short_url', 7);
            $table->string('original_url');
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'short_link_user_id'
            );
            $table->timestamps();
        });
    }
};
