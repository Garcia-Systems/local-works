<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_requests', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 254);
            $table->string('phone', 40)->nullable();
            $table->string('business_name', 160);
            $table->string('business_website', 2048)->nullable();
            $table->string('business_type', 120)->nullable();
            $table->string('business_location', 160)->nullable();
            $table->text('friction_description');
            $table->text('current_process');
            $table->text('desired_improvement')->nullable();
            $table->text('additional_context')->nullable();
            $table->string('utm_source', 255)->nullable();
            $table->string('utm_medium', 255)->nullable();
            $table->string('utm_campaign', 255)->nullable();
            $table->string('utm_content', 255)->nullable();
            $table->string('utm_term', 255)->nullable();
            $table->string('referrer', 2048)->nullable();
            $table->string('landing_page', 2048)->nullable();
            $table->string('status', 20)->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_requests');
    }
};
