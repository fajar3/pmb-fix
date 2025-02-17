<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'gender',
        'birth_place',
        'birth_date',
        'citizenship',
        'address',
        'rt',
        'rw',
        'dusun',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'father_name',
        'father_birth_year',
        'father_status',
        'father_education',
        'father_job',
        'father_phone',
        'mother_name',
        'mother_birth_year',
        'mother_status',
        'mother_education',
        'mother_job',
        'mother_phone',
        'guardian_name',
        'guardian_birth_year',
        'guardian_status',
        'guardian_education',
        'guardian_job',
        'guardian_phone',
        'agreement_lillah',
        'agreement_parent',
        'agreement_rules',
        'agreement_administration',
        'agreement_no_return',
        'kk_copy',
        'birth_certificate_copy',
        'payment_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
