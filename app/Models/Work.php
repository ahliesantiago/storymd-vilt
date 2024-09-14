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
      
      $searchWord = function($query, $column, $search){
          $query->where($column, $search) // search exact match
            ->orWhere($column, 'like', "{$search}%") // search beginning of the column value
            ->orWhere($column, 'like', "% {$search}%") // search  of the column value
            ->orWhere($column, 'like', "% {$search}"); // search end of the column value
      };

      if(isset($filters['search'])){
        $search = $filters['search'];

        // If the search query's characters are 4 or more, search anywhere in the title, summary, tags, and fandoms
        if(strlen($search) > 3){
          $query->where('title', 'like', '%' . $search . '%')
          ->orWhereHas('chapters', function($query) use ($search){
            $query
              ->where('position', 1)
              ->where('summary', 'like', '%' . $search . '%');
          })
          ->orWhereHas('tags', function($query) use ($search){
            $query->where('tag_name', 'like', '%' . $search . '%');
          })
          ->orWhereHas('fandoms', function($query) use ($search){
            $query->where('fandom_name', 'like', '%' . $search . '%');
          });
        // If the search query consists only of 1-3 characters, search for exact word matches within the title, summary, tags, and fandoms
        }else{
          $query->where(function($query) use ($search, $searchWord){
            $searchWord($query, 'title', $search);
          })
          ->orWhereHas('tags', function($query) use ($search, $searchWord){
            $searchWord($query, 'tag_name', $search);
          })
          ->orWhereHas('fandoms', function($query) use ($search, $searchWord){
            $searchWord($query, 'fandom_name', $search);
          })
          ->orWhereHas('chapters', function($query) use ($search, $searchWord){
            $query
              ->where('position', 1)
              ->where('summary', $search)
              ->orWhere('summary', 'like', "{$search} %")
              ->orWhere('summary', 'like', "% {$search} %")
              ->orWhere('summary', 'like', "% {$search}");
          });
        }
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
