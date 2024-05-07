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
        Schema::create('indicator_reports', function (Blueprint $table) {
            $table->id();
            $table->string('RID');
            $table->string('IID');
            $table->text('Entity');
            $table->text('ReportedBy')->nullable();
            $table->text('Response');
            $table->text('Comments');
            $table->integer('IndicatorResponsePercentageScore');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicator_reports');
    }
};
