<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->enum('type', ['buyer', 'investor', 'both'])->default('buyer');
            $table->text('investment_criteria')->nullable();
            $table->decimal('min_investment', 15, 2)->nullable();
            $table->decimal('max_investment', 15, 2)->nullable();
            $table->json('preferred_industries')->nullable();
            $table->json('preferred_stages')->nullable();
            $table->json('preferred_locations')->nullable();
            $table->text('investment_goals')->nullable();
            $table->integer('typical_deal_size_min')->nullable();
            $table->integer('typical_deal_size_max')->nullable();
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('verification_documents')->nullable(); // JSON
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('buyers');
    }
};
