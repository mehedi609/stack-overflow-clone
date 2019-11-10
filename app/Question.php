<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

  public function favorites()
  {
      return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
  }

  // title Mutators
  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;
    $this->attributes['slug'] = Str::slug($value);
  }

  // $question->url accessor
  public function getUrlAttribute()
  {
    return route('questions.show', $this->slug);
  }

  // $question->body_html accessor
  public function getBodyHtmlAttribute()
  {
    return \Parsedown::instance()->text($this->body);
  }

  // $question->status accessor
  public function getStatusAttribute()
  {
    if ($this->answers_count > 0) {
      if ($this->best_answer_id)
        return "answer-accepted";
      return "answered";
    }
    return "unanswered";
  }

  // $question->created_date accessor
  public function getCreatedDateAttribute()
  {
    return $this->created_at->diffForHumans();
  }

  public function acceptBestAnswer(Answer $answer)
  {
    $this->best_answer_id = $answer->id;
    $this->save();
  }

  private function isFavorited()
  {
    return $this->favorites()->where('user_id', auth()->id())->count() > 0;
  }

  public function getisFavoritedAttribute()
  {
    return $this->isFavorited();
  }

  public function getFavoritesCountAttribute()
  {
    return $this->favorites->count();
  }

  /*public function getEditAttribute()
  {
    return route('questions.edit', $this->id);
  }

  public function getUpdateAttribute()
  {
    return route('questions.update', $this->id);
  }*/
}
