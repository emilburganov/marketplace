<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->integer('discount_price')
                ->virtualAs( 'price * (1 - discount / 100)' );
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('seller_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
