<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('investment_opportunities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_listing_id');
            $table->string('title');
            $table->text('description');
            $table->decimal('min_investment', 15, 2);
            $table->decimal('max_investment', 15, 2)->nullable();
            $table->decimal('target_amount', 15, 2);
            $table->decimal('current_amount', 15, 2)->default(0);
            $table->integer('investors_count')->default(0);
            $table->decimal('expected_roi', 5, 2)->nullable(); // Percentage
            $table->integer('investment_duration')->nullable(); // Months
            $table->enum('investment_type', ['equity', 'debt', 'hybrid'])->default('equity');
            $table->text('use_of_funds')->nullable();
            $table->text('exit_strategy')->nullable();
            $table->enum('status', ['draft', 'open', 'closed', 'funded'])->default('draft');
            $table->date('closing_date')->nullable();
            $table->timestamps();
            
            $table->foreign('business_listing_id')->references('id')->on('business_listings')->onDelete('cascade');
            $table->index(['status', 'investment_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('investment_opportunities');
    }
};
