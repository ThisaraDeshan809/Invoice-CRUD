<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;


    protected $fillable = [
      'user_id',
      'paymentType',
      'description',
      'total_price',
      'date',
      'due_date',
      'address',
      'email',
      'status'
    ];

    public function Items()
    {
      return $this->hasMany(Item::class ,'invoice_id');
    }
}