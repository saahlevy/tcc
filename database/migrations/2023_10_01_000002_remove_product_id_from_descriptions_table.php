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
        Schema::table('descriptions', function (Blueprint $table) {
            $table->dropForeign(['product_id']); // Remover a chave estrangeira
            $table->dropColumn('product_id'); // Remover a coluna product_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('descriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id'); // Recriar a coluna product_id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // Recriar a relação
        });
    }
};
