<?php

use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('name_person');
            $table->string('email_person');
            $table->string('address_person');
            $table->string('phone_person');

            $table->boolean('status')->default(false);
            $table->string('name_receiver');
            $table->string('email_receiver');
            $table->string('address_receiver');
            $table->string('phone_receiver');
            $table->unsignedBigInteger('total_amount');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
