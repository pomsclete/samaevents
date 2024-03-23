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
        Schema::create('preinscription_has_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preinscription_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_has_formation_id')->constrained()->cascadeOnDelete();
            $table->string('document');
            $table->integer('valide')->default(0);
            $table->integer('userId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preinscription_has_documents');
    }
};
