<?php

namespace Modules\DiscountCode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployerTaskDiscountCodes extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\DiscountCode\Database\factories\EmployerTaskDiscountCodesFactory::new();
    }
}
