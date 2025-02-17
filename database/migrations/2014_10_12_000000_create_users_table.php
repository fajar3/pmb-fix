<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('citizenship', ['WNI', 'WNA']);
            $table->text('address');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('dusun')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('father_name');
            $table->year('father_birth_year');
            $table->enum('father_status', ['Masih Hidup', 'Sudah Meninggal']);
            $table->string('father_education');
            $table->string('father_job');
            $table->string('father_phone');
            $table->string('mother_name');
            $table->year('mother_birth_year');
            $table->enum('mother_status', ['Masih Hidup', 'Sudah Meninggal']);
            $table->string('mother_education');
            $table->string('mother_job');
            $table->string('mother_phone');
            $table->string('guardian_name')->nullable();
            $table->year('guardian_birth_year')->nullable();
            $table->enum('guardian_status', ['Masih Hidup', 'Sudah Meninggal'])->nullable();
            $table->string('guardian_education')->nullable();
            $table->string('guardian_job')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->boolean('agreement_lillah')->default(false);
            $table->string('kk_copy')->default(false);
            $table->string('birth_certificate_copy')->default(false);
            $table->boolean('form_status')->default(false);
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('users');
    }
}
