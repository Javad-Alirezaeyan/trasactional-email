<?php

use Illuminate\Database\Seeder;
use App\Email;
class EmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Email::truncate();

        $faker = \Faker\Factory::create();

        $recv = [];
        for($i=1; $i <= rand(1, 10); $i++){
            $recv[] =  $faker->freeEmail;
        }
        $to = implode(',', $recv);
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 200; $i++) {
            Email::create([
                'email_subject' => $faker->sentence,
                'email_contentValue' => $faker->text ,
                'email_to' => $to,
                'email_from' => $faker->freeEmail ,
                'email_state'=> $faker->numberBetween(0,2),
                'email_service'=> $faker->numberBetween(0,1),
                'email_contentType' => 'text/html'
            ]);
        }
    }
}
