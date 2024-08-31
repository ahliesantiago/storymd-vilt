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

    public function rating(){
      return $this->belongsTo(Rating::class);
    }

    public function categories(){
      return $this->belongsToMany(Category::class, 'work_categories');
    }

    public function fandoms(){
      return $this->belongsToMany(Fandom::class, 'work_fandoms')
        ->withPivot('is_major');
    }

    public function warnings(){
      return $this->belongsToMany(Warning::class, 'work_warnings');
    }

    public function tags(){
      return $this->belongsToMany(Tag::class, 'work_tags')
        ->withPivot('is_major');
    }
}
