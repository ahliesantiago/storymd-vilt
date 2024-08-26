<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
      dd($filters['tag']);
    }

    public function creator(){
      return $this->belongsTo(User::class, 'creator_id');
    }

    public function chapters(){
      return $this->hasMany(Chapter::class)->orderBy('position');
    }

    public function language(){
      return $this->belongsTo(Language::class, 'language_code', 'language_code');
    }
}
