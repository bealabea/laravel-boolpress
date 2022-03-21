<?php

use Illuminate\Support\Str;
use App\Post;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
            "image"=> "https://www.meganerd.it/wp-content/uploads/2022/03/Spiderman-nwh-03.jpeg",
            "title"=> "Spiderman No Way Home",
            "content"=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non risus id ex sagittis sagittis vel sed elit. Aliquam justo est, elementum eget varius vitae, ultrices quis nunc. Sed viverra hendrerit libero. Vivamus luctus maximus aliquam. Aliquam non lectus condimentum, pharetra mauris et, aliquam ligula. Praesent commodo finibus mauris, eu varius neque fringilla sit amet. Nullam quam lorem, congue ut semper facilisis, consectetur a erat. Proin risus orci, hendrerit non tristique quis, consectetur vel neque. Vestibulum volutpat sed urna ut feugiat. Sed mattis et metus a semper. Duis sollicitudin est vel egestas condimentum.",
            "slug"=> "spiderman-no-way-home",
            "user_id"=> "1",
            "category_id"=> "3"
            ],
            [
            "image"=> "https://sm.ign.com/t/ign_it/review/t/the-batman/the-batman-review_3khk.1280.jpg",
            "title"=> "Batman",
            "content"=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non risus id ex sagittis sagittis vel sed elit. Aliquam justo est, elementum eget varius vitae, ultrices quis nunc. Sed viverra hendrerit libero. Vivamus luctus maximus aliquam. Aliquam non lectus condimentum, pharetra mauris et, aliquam ligula. Praesent commodo finibus mauris, eu varius neque fringilla sit amet. Nullam quam lorem, congue ut semper facilisis, consectetur a erat. Proin risus orci, hendrerit non tristique quis, consectetur vel neque. Vestibulum volutpat sed urna ut feugiat. Sed mattis et metus a semper. Duis sollicitudin est vel egestas condimentum.",
            "slug"=> "batman",
            "user_id"=> "1",
            "category_id"=> "3"
            ],
            [
            "image"=> "https://immagini.quotidiano.net/?url=http%3A%2F%2Fp1014p.quotidiano.net%3A80%2Fpolopoly_fs%2F1.7095929.1638296020%21%2FhttpImage%2Fimage.jpg_gen%2Fderivatives%2Fwidescreen%2Fimage.jpg&w=1320&h=742",
            "title"=> "Il potere del cane",
            "content"=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non risus id ex sagittis sagittis vel sed elit. Aliquam justo est, elementum eget varius vitae, ultrices quis nunc. Sed viverra hendrerit libero. Vivamus luctus maximus aliquam. Aliquam non lectus condimentum, pharetra mauris et, aliquam ligula. Praesent commodo finibus mauris, eu varius neque fringilla sit amet. Nullam quam lorem, congue ut semper facilisis, consectetur a erat. Proin risus orci, hendrerit non tristique quis, consectetur vel neque. Vestibulum volutpat sed urna ut feugiat. Sed mattis et metus a semper. Duis sollicitudin est vel egestas condimentum.",
            "slug"=> "il-potere-del-cane",
            "user_id"=> "1",
            "category_id"=> "5"
            ],
        ];
    
          foreach ($posts as $postData) {
            $post = new Post();
            $post->fill($postData);
            $post->save();
        }
    }
}
