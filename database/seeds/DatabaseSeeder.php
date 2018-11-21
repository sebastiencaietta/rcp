<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Facile',
            'Long',
            'Healthy',
            'Party',
            'Gluten free',
            'Gluten full',
            'Boissons',
            'Paleo',
        ];

        $units = [
            'kg',
            'g',
            'teaspoon',
            'tablespoon',
            'cup',
            'L',
            'ml'
        ];

        $categories = [
            'Entrées' => 'entrees',
            'Plats Principaux' => 'plats-principaux',
            'Desserts' => 'desserts',
        ];
    }
}
