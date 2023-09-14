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
        Schema::create('taikhoan', function (Blueprint $table) {
            $table->increments("MaTK");
            $table->string("TenDangNhap", 20);
            $table->text("MatKhau", 20);
            $table->unsignedInteger("MaGV");

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
        Schema::dropIfExists('taikhoan');
    }
};