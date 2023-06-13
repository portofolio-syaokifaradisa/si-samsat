<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip');
            $table->enum('gender', [
                'Laki-laki',
                'Perempuan'
            ]);
            $table->string('position');
            $table->string('phone');
            $table->text('address');
            $table->enum('status', [
                'SUDAH MENIKAH',
                'BELUM MENIKAH'
            ]);
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
        Schema::dropIfExists('officers');
    }
}
