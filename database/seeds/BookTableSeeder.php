<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Storage::disk('local')->delete(Storage::allFiles());
    	// création des genres
    	App\Genre::create([
    		'name' => 'science'

    	]);

    	App\Genre::create([
    		'name' => 'maths'

    	]);

    	App\Genre::create([
    		'name' => 'cookbook'

    	]);

        //création de 5 livres
        factory(App\Book::class, 5)->create()->each(function($book){;
	        $genre = App\Genre::find(rand(1,3));

	        $book->genre()->associate($genre);
	        $book->save();

	        //ajout des images
	        $link = str_random(12) . 'jpg';
	        $file = file_get_contents('https://loremflickr.com/g/320/240/paris');
	        Storage::disk('local')->put($link, $file);

            $book->picture()->create([
                'title' => 'Default', // valeur par défaut
                'link' => $link
            ]);

            $authors =App\Author::pluck('id')->shuffle()->slice(0,rand(1,3))->all();

            $relationPivotAuthor= [];

            foreach ($authors as $id) {
                $relationPivotAuthor[$id] = ['note' => rand(5,19) + rand(0,9)/10 ];
            }

            $book->authors()->attach($relationPivotAuthor);
           
    	});
    }
}
