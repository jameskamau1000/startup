<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_valuations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_listing_id');
            $table->unsignedBigInteger('user_id'); // Who requested
            $table->decimal('estimated_value', 15, 2);
            $table->decimal('min_value', 15, 2)->nullable();
            $table->decimal('max_value', 15, 2)->nullable();
            $table->text('valuation_method')->nullable(); // Revenue multiple, Asset-based, etc.
            $table->text('valuation_report')->nullable(); // Detailed report
            $table->json('valuation_factors')->nullable(); // Key factors considered
            $table->enum('status', ['pending', 'completed', 'rejected'])->default('pending');
            $table->unsignedBigInteger('valued_by')->nullable(); // Expert who did valuation
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->foreign('business_listing_id')->references('id')->on('business_listings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('valued_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_valuations');
    }
};
