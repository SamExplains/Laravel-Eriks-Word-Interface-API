<?php

use Illuminate\Database\Seeder;
use App\Word;
use Faker\Generator as Faker;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{

  /**
   * Seed the application's database.
   *
   * @param Faker $faker
   * @return void
   */
    public function run(Faker $faker)
    {

      $start = new Carbon('2018-12-31');
      $copy = clone  $start;

      for ($i=1; $i < 366; $i++) {
//        $today = explode(' ', Carbon::now()->addRealDay($i)->toDateTimeString() )[0];
        $next = explode(' ', $copy->addRealDay()->toDateTimeString() )[0];
        Word::create([
          'longdate' => $next,
          'word' => ucfirst($faker->firstName) . '-' . ucfirst($faker->lastName)
        ]);
      }

    }
}
