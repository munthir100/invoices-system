<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasPermissions;
    use HasRoles;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status_id',
        'user_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
    public function administrator()
    {
        return $this->hasOne(Administrator::class);
    }
    public function salesperson()
    {
        return $this->hasOne(Administrator::class);
    }

    // scopes

    public function scopeIsAdmin($query)
    {
        return $query->where('user_type_id',UserType::ADMIN);
    }
    public function scopeSalesperson($query)
    {
        return $query->where('user_type_id',UserType::SALESPERSON);
    }
}
