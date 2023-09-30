<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    const ADMIN = 1;
    const SALESPERSON = 2;
    
    function user()
    {
        return $this->hasMany(User::class);
    }
}
