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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', ['admin', 'user'])->default('user');
            $table->string('avatar')->default('/default/avatar.png')->nullable();
            $table->string('banner')->default('/default/breadcrumb.png')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->text('about')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('website')->nullable();
            $table->text('fb_link')->nullable();
            $table->text('x_link')->nullable();
            $table->text('in_link')->nullable();
            $table->text('wa_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
