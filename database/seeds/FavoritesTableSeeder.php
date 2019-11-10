<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->delete();

        $users = User::pluck('id')->all();
        $numOfUsers = count($users);

        foreach (Question::all() as $question) {
          $length = rand(1, $numOfUsers);

          for ($i = 0; $i < $length; $i++) {
            $question->favorites()->attach($users[$i]);
          }
        }
    }
}
