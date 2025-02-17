<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminBankPutri extends Model
{
    use HasFactory;

    protected $table = 'admin_bank_putri';
    protected $fillable = ['bank_type', 'account_name', 'account_number', 'nominal'];
}
