<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePajaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pajaks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('ktp');
            $table->string('stnk');
            $table->string('bpkb_first_page');
            $table->string('bpkb_second_page');
            $table->string('bpkb_third_page');
            $table->string('bpkb_fourth_page');
            $table->string('notice_pajak');
            $table->integer('price')->nullable();
            $table->string('machine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->date('time_limit')->nullable();
            $table->enum('type', [1, 5]);
            $table->enum('status', [
                'TERKIRIM',
                'DIBATALKAN',
                'DITERIMA',
                'SELESAI',
                'DITOLAK'
            ])->default('TERKIRIM');
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
        Schema::dropIfExists('pajaks');
    }
}
