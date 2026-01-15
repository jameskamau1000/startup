<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_listing_id');
            $table->unsignedBigInteger('sender_id'); // Buyer/Investor
            $table->unsignedBigInteger('receiver_id'); // Seller
            $table->text('message');
            $table->boolean('read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            $table->foreign('business_listing_id')->references('id')->on('business_listings')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['business_listing_id', 'sender_id', 'receiver_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_messages');
    }
};
