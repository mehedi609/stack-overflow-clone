<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function questions()
  {
    return $this->hasMany(Question::class);
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

  public function favorites()
  {
      return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
  }

  public function voteQuestions()
  {
      return $this->morphedByMany(Question::class, 'votable');
  }

  public function voteAnswers()
  {
      return $this->morphedByMany(Answer::class, 'votable');
  }

  public function voteQuestion(Question $question, $vote)
  {
    if ($this->voteQuestions()->where('votable_id', $question->id)->exists())
      $this->voteQuestions()->updateExistingPivot($question, ['vote' => $vote]);
    else
      $this->voteQuestions()->attach($question, ['vote' => $vote]);

    $question->load('votes');
    $downVotes = (int)$question->downVotes()->sum('vote');
    $upVotes = (int)$question->upVotes()->sum('vote');

    $question->votes_count = $upVotes + $downVotes;
    $question->save();
  }

  public function voteAnswer(Answer $answer, $vote)
  {
    if ($this->voteAnswers()->where('votable_id', $answer->id)->exists())
      $this->voteAnswers()->updateExistingPivot($answer, ['vote' => $vote]);
    else
      $this->voteAnswers()->attach($answer, ['vote' => $vote]);

    $answer->load('votes');
    $downVotes = (int)$answer->downVotes()->sum('vote');
    $upVotes = (int)$answer->upVotes()->sum('vote');

    $answer->votes_count = $upVotes + $downVotes;
    $answer->save();
  }

  // user->url accessor
  public function getUrlAttribute()
  {
    return '#';
  }

  public function getAvatarAttribute()
  {
    $email = $this->email;
    $size = 32;
    $md5str = md5( strtolower( trim( $email ) ) );

    return "https://www.gravatar.com/avatar/{$md5str}?s={$size}";
  }

}
