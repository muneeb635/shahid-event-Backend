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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->string('hall');
            $table->date('date');
            $table->float('marque_revenue');
            $table->float('owner_revenue');
            $table->float('partner_revenue');

            $table->unsignedBigInteger('marquee_id');
            $table->foreign('marquee_id')->references('id')->on('marquees')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
