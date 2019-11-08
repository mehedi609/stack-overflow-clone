<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function question()
  {
    return $this->belongsTo(Question::class);
  }

  // $answer->body_html accessor
  public function getBodyHtmlAttribute()
  {
    return \Parsedown::instance()->text($this->body);
  }

  // $answer->created_date accessor
  public function getCreatedDateAttribute()
  {
    return $this->created_at->diffForHumans();
  }

  public static function boot()
  {
    parent::boot();

    static::created(function ($answer) {
      $answer->question->increment('answers_count');
    });
  }
}
