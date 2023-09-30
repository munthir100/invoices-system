<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['invoice_number', 'date', 'due_date', 'salesperson_id', 'customer_id', 'status_id'];

    public function salesperson()
    {
        return $this->belongsTo(Salesperson::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
