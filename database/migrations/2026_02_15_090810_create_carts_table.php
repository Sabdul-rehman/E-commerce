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
       Schema::create('carts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // logged-in
            $table->string('session_id')->nullable(); // guest

            $table->unsignedBigInteger('Cid'); // product reference

            $table->foreign('Cid')
                ->references('Cid')
                ->on('categories')
                ->onDelete('cascade');

            $table->string('size')->nullable();
            $table->string('type')->nullable();

            $table->integer('quantity')->default(1);

            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
