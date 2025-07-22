<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('units', function (Blueprint $table) {
        $table->id();
        $table->string('no')->unique();
        $table->string('nama');
        $table->string('singkatan');
        $table->integer('urut')->nullable();
        $table->foreignId('parent_id')->nullable()->constrained('units')->onDelete('set null');
        $table->boolean('aktif')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
};