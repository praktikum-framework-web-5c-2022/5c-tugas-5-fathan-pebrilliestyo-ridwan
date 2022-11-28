<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Sosmed;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create('id_ID');
        $faker->seed(123);
        $status = ['Aktif','Tidak Aktif'];
            

        for($i=0; $i<15; $i++){
            Member::create([
                'username' => $faker->unique()->bothify('?????##'),
                'nama' => $faker->firstName. " ".$faker->lastName,
                'status' => $faker->randomElement($status)
            ]);
        }

        for($i=0; $i<8; $i++){
            Sosmed::create([
                'facebook'=> $faker->firstName." ".$faker->bothify('?????'),
                'instagram' => $faker->regexify('[a-z0-9]{8}'),
                'whatsapp' => $faker->numerify("8#########"),
                'member_id'=> $faker->unique()->numberBetween(1,9),
            ]);
        }
    }
}
