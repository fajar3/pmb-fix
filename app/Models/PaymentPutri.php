<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPutri extends Model
{
    use HasFactory;
    
    protected $table = 'payments_putri';
    protected $fillable = [
        'user_id', 'bank_type', 'account_name', 'account_number',
        'description', 'payment_number', 'proof', 'status', 'nominal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
