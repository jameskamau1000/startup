<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investment_opportunity_id');
            $table->unsignedBigInteger('investor_id');
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            
            $table->foreign('investment_opportunity_id')->references('id')->on('investment_opportunities')->onDelete('cascade');
            $table->foreign('investor_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['investment_opportunity_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('investments');
    }
};
