<?php

use CQ\DB\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Seeder::faker();
        $data = [];

        for ($i = 0; $i < 3; ++$i) {
            $data[] = [
                'id' => $faker->uuid,
                'score' => $faker->numberBetween(0, 5),
                'name' => $faker->name,
                'description' => $faker->sentence,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->table('reviews')->insert($data)->saveData();
    }
}
