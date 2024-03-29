<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = config("tags");

        foreach ($tags as $tag) {
            $NewTags = new Tag();
            $NewTags->fill($tag);
            $NewTags->save();
        }
    }
}
