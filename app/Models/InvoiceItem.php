<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'quantity', 'price', 'tax_rate', 'invoice_id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

}
