<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('full_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('nationality', ['WNI', 'WNA']);
            $table->text('address');
            $table->string('rt');
            $table->string('rw');
            $table->string('village');
            $table->string('district');
            $table->string('city');
            $table->string('province');
            
            // Father's data
            $table->string('father_name');
            $table->year('father_birth_year');
            $table->enum('father_status', ['alive', 'deceased']);
            $table->string('father_education');
            $table->string('father_occupation');
            $table->string('father_phone');
            
            // Mother's data
            $table->string('mother_name');
            $table->year('mother_birth_year');
            $table->enum('mother_status', ['alive', 'deceased']);
            $table->string('mother_education');
            $table->string('mother_occupation');
            $table->string('mother_phone');
            
            // Guardian's data
            $table->string('guardian_name')->nullable();
            $table->year('guardian_birth_year')->nullable();
            $table->string('guardian_education')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_phone')->nullable();
            
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->timestamps();
        });
        
        // payments table
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('student_registrations');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['online', 'offline']);
            $table->string('proof_of_payment')->nullable();
            $table->enum('status', ['pending', 'verified', 'rejected']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
        
        // settings table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->text('value');
            $table->string('type');
            $table->timestamps();
        });
        
        // documents table
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('student_registrations');
            $table->string('document_type'); // KK, birth_certificate, etc.
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registration');
    }
};
