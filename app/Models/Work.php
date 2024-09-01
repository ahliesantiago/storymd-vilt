<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
      if(isset($filters['tag'])){
        $tag = $filters['tag'];

        $query->whereHas('tags', function($query) use ($tag){
          $query->where('tag_name', $tag);
        })
        ->orWhereHas('fandoms', function($query) use ($tag){
          $query->where('fandom_name', $tag);
        })
        ->orWhereHas('rating', function($query) use ($tag){
          $query->where('rating_name', $tag);
        })
        ->orWhereHas('categories', function($query) use ($tag){
          $query->where('category_name', $tag);
        })
        ->orWhereHas('warnings', function($query) use ($tag){
          $query->where('warning_name', $tag);
        });
      }

      if(isset($filters['search'])){
        $search = $filters['search'];

        $query->where('title', 'like', '%' . $search . '%')
        ->orWhereHas('chapters', function($query) use ($search){
          $query
            ->where('summary', 'like', '%' . $search . '%')
            ->where('position', 1);
        })
        ->orWhereHas('tags', function($query) use ($search){
          $query->where('tag_name', 'like', '%' . $search . '%');
        })
        ->orWhereHas('fandoms', function($query) use ($search){
          $query->where('fandom_name', 'like', '%' . $search . '%');
        });
      }
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
