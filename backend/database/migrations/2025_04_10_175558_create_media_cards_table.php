<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('media_cards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('media_title');
            $table->string('entry_title');
            $table->string('entry_author');
            $table->string('entry_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_cards');
    }
};
