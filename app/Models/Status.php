<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    const NEW = 1;
    const PENDING = 2;
    const PAID = 3;
    const OVERDUE = 4;
    const ACTIVE = 5;
    const BLOCKED = 6;
}
