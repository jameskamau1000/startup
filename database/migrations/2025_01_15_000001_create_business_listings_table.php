<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Seller
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('industry'); // Technology, Retail, Hospitality, etc.
            $table->string('stage'); // early, pre-revenue, established
            $table->string('location'); // City, Country
            $table->decimal('asking_price', 15, 2);
            $table->decimal('annual_revenue', 15, 2)->nullable();
            $table->decimal('annual_profit', 15, 2)->nullable();
            $table->integer('years_in_business')->nullable();
            $table->integer('employees')->nullable();
            $table->string('business_type')->nullable(); // B2C, B2B, B2C & B2B
            $table->text('key_metrics')->nullable(); // JSON
            $table->text('financial_summary')->nullable();
            $table->text('growth_potential')->nullable();
            $table->text('reason_for_sale')->nullable();
            $table->string('main_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->enum('status', ['draft', 'pending', 'active', 'sold', 'inactive'])->default('pending');
            $table->boolean('featured')->default(false);
            $table->boolean('verified')->default(false);
            $table->integer('views')->default(0);
            $table->integer('inquiries')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['status', 'featured']);
            $table->index(['industry', 'stage', 'location']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_listings');
    }
};
