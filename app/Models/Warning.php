<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;

    public function works(){
      return $this->belongsToMany(Work::class, 'work_warnings');
    }
}
