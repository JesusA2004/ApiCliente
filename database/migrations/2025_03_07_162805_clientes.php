<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre');
            $table->string('Apellido'); 
            $table->string('Email')->unique();
            $table->string('Telefono')->nullable(); 
            $table->string('Ciudad')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
