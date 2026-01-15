<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_inquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_listing_id');
            $table->unsignedBigInteger('buyer_id');
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'responded', 'closed'])->default('pending');
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
            
            $table->foreign('business_listing_id')->references('id')->on('business_listings')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['business_listing_id', 'buyer_id']);
            $table->index(['business_listing_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_inquiries');
    }
};
