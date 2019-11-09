<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $guarded = [];

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

  // $answer->status accessor
  public function getStatusAttribute()
  {
    if ($this->id == $this->question->best_answer_id)
      return 'vote-accepted';
    return '';
  }

  public static function boot()
  {
    parent::boot();

    static::created(function ($answer) {
      $answer->question->increment('answers_count');
    });

    static::deleted(function ($answer) {
      $question = $answer->question;
      $question->decrement('answers_count');
      if ($question->best_answer_id == $answer->id) {
        $question->best_answer_id = NULL;
        $question->save();
      }
    });
  }
}
