<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasis', function (Blueprint $table) {
            $table->id();
            $table->string('stnk');
            $table->string('notice_pajak');

            $table->string('ktp');

            $table->string('bpkb1');
            $table->string('bpkb2');
            $table->string('bpkb3');
            $table->string('bpkb4');

            $table->string('kwitansi')->nullable();
            $table->string('polda_recommendation');

            $table->integer('price')->nullable();
            $table->date('time_limit')->nullable();
            
            $table->string('machine_number');
            $table->string('chassis_number');

            $table->string('surat_fiskal')->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->enum('status', [
                'DIBATALKAN',
                'TERKIRIM',
                'DITERIMA',
                'SELESAI',
                'DITOLAK'
            ])->default('TERKIRIM');
            $table->enum('type', ['KELUAR', 'MASUK', 'NOPOL']);
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
        Schema::dropIfExists('mutasis');
    }
}
