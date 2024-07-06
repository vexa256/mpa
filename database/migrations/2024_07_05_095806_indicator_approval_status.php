<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. NOT CURRENTLY USED
     */
    public function up(): void
    {
        Schema::create('indicator_approval_status', function (Blueprint $table) {
            $table->id();
            $table->string('RID');
            $table->string('IID');
            $table->string('AID');
            $table->string('Entity');
            $table->string('ApprovalStatus');
            $table->text('ApprovalComments');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicator_approval_status');
    }
};
