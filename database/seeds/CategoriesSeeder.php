<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $categories = [
          ["genre"=> "thriller"],
          ["genre"=> "comedy"],
          ["genre"=> "action"],
          ["genre"=> "fantasy"],
          ["genre"=> "adventure"],
          ["genre"=> "romance"]
        ];
        foreach ($categories as $category) {
            $newCat = new Category();

            $newCat->fill($category);
            $newCat->save();
          }
    }
}
