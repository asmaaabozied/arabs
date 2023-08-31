<?php

namespace Modules\Task\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskCategoryAction extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Task\Database\factories\TaskCategoryActionFactory::new();
    }
}