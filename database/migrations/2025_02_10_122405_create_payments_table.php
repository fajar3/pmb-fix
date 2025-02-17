<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payments_putra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('bank_type'); // Jenis Rekening
            $table->string('account_name'); // Nama Rekening
            $table->string('account_number'); // Nomor Rekening
            $table->decimal('nominal', 15, 2); // Nominal pembayaran
            $table->text('description')->nullable(); // Keterangan
            $table->string('payment_number')->unique(); // Nomor Pembayaran
            $table->string('proof')->nullable(); // Bukti Pembayaran (File)
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('payments_putri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('bank_type'); // Jenis Rekening
            $table->string('account_name'); // Nama Rekening
            $table->string('account_number'); // Nomor Rekening
            $table->decimal('nominal', 15, 2); // Nominal pembayaran
            $table->text('description')->nullable(); // Keterangan
            $table->string('payment_number')->unique(); // Nomor Pembayaran
            $table->string('proof')->nullable(); // Bukti Pembayaran (File)
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments_putra');
        Schema::dropIfExists('payments_putri');
    }
};
