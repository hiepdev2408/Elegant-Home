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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount_amount', 10, 2)->nullable(); // Giảm giá theo số tiền
            $table->decimal('discount_percent', 5, 2)->nullable(); // Giảm giá theo phần trăm
            $table->dateTime('start_date'); // Thời gian bắt đầu
            $table->dateTime('end_date'); // Thời gian kết thúc
            $table->integer('usage_limit')->nullable(); // Giới hạn sử dụng
            $table->integer('used_count')->default(0); // Số lần đã sử dụng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
