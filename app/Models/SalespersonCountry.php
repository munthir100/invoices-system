<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalespersonCountry extends Model
{
    use HasFactory;
    protected $fillable = ['salesperson_id', 'country_id'];

    public function salesperson()
    {
        return $this->belongsTo(Salesperson::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
