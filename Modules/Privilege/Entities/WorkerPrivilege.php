<?php

namespace Modules\Privilege\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkerPrivilege extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Privilege\Database\factories\WorkerPrivilegeFactory::new();
    }
}
