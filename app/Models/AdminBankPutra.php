<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminBankPutra extends Model
{
    use HasFactory;

    protected $table = 'admin_bank_putra';
    protected $fillable = ['bank_type', 'account_name', 'account_number', 'nominal'];
}
