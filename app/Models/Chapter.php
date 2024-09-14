<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'work_id', 'position', 'chapter_title', 'content', 'summary', 'beginning_notes', 'end_notes', 'word_count', 'is_published', 'published_at', 'revised_at'];

    public function work(){
      return $this->belongsTo(Work::class);
    }

    // public function setWordCount(){
    //   $this->word_count = $this->str_word_count($this->content);
    //   return $this;
    // }
}
