<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salesperson extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'salesperson_countries', 'salesperson_id', 'country_id');
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'salesperson_id');
    }
    

}
