<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ChiTietMonHoc', function (Blueprint $table) {
            $table->integer("SoLuongSV");
            $table->integer("SoTiet");
            $table->integer("SoChiTH");
            $table->string('MaMH');
            $table->unsignedInteger('MaHK');
            $table->unsignedInteger('MaNH');
            $table->unsignedInteger('MaLop');
            $table->unsignedInteger("MaGV");

            $table->foreign(['MaMH'])
                ->references('MaMH')->on('MonHoc')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign(['MaHK'])
                ->references('MaHK')->on('HocKi')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign(['MaNH'])
                ->references('MaNH')->on('NamHoc')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign(['MaLop'])
                ->references('MaLop')->on('Lop')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign(['MaGV'])
                ->references('MaGV')->on('GiangVien')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ChiTietMonHoc');
    }
};