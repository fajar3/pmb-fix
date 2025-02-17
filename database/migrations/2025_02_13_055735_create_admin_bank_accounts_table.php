<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel untuk Putra
        Schema::create('admin_bank_putra', function (Blueprint $table) {
            $table->string('bank_type');
            $table->string('account_name');
            $table->string('account_number');
            $table->decimal('nominal', 15, 2)->default(0);
            $table->timestamps();
        });

        // Tabel untuk Putri
        Schema::create('admin_bank_putri', function (Blueprint $table) {
            $table->string('bank_type');
            $table->string('account_name');
            $table->string('account_number');
            $table->decimal('nominal', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_bank_putra');
        Schema::dropIfExists('admin_bank_putri');
    }
};
