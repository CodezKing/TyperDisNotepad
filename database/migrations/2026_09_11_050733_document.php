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
        //
        Schema::create('Document', function (Blueprint $table) {
            $table->id('document_id');
            $table->string('document_name');
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
                    ->references('account_id')
                    ->on('Account');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('document');
    }
};
