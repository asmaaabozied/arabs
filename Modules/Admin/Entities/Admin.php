<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Role\Entities\Role;

class Admin extends Model
{
    use HasFactory,SoftDeletes;
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'administrative_number',
        'role_id',
        'status',
        'password',
        'current_currency',


    ];

    protected $hidden = [
//        'password',
    ];

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
