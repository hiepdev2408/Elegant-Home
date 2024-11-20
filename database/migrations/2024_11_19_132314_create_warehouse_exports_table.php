<?php

use App\Models\User;
use App\Models\warehouse;
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
        Schema::create('warehouse_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(warehouse::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->integer('quantity')->default(0);
            $table->datetime('Shipment_date');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_exports');
    }
};
