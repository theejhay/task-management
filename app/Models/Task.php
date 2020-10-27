<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $with = 'project';

    protected $fillable = [
        'name', 'description', 'project_id', 'priority', 'position'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }
}
