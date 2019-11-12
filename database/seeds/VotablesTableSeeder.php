<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotablesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('votables')->where('votable_type', 'App\Question')->delete();

    $users = User::all();
    $totalUsers = $users->count();
    $vote = [-1, 1];

    foreach (Question::all() as $question) {
      for ($i = 0; $i < rand(1, $totalUsers); $i++) {
        $users[$i]->voteQuestion($question, $vote[rand(0, 1)]);
      }
    }
  }
}
