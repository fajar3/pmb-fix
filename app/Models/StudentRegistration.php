<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'status'];

    /**
     * Relasi dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan Documents (Dokumen yang diunggah oleh mahasiswa)
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Relasi dengan Payments (Pembayaran terkait pendaftaran)
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}