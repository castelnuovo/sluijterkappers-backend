<?php

use CQ\DB\Seeder;

class ProductsSeeder extends Seeder
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

        for ($i = 0; $i < 5; ++$i) {
            $data[] = [
                'id' => $faker->uuid,
                'image' => $faker->imageUrl,
                'name' => $faker->name,
                'price' => $faker->randomFloat(2, 1, 100),
                'category' => 'marc_inbane',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->table('products')->insert($data)->saveData();
    }
}
