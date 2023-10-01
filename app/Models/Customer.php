<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone', 'type', 'language', 'salesperson_id'];

    public function salesperson()
    {
        return $this->belongsTo(Salesperson::class);
    }

    public function address()
    {
        return $this->hasOne(CustomerAddress::class);
    }
}
