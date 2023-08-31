<?php

namespace Modules\Mail\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemporaryEmployerToken extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Mail\Database\factories\TemporaryEmployerTokenFactory::new();
    }
}
