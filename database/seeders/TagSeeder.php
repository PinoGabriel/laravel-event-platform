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
        $array_tag = config("tags");

        foreach ($array_tag as $tag_item) {
            $array_tag = new Tag();
            $array_tag->fill($tag_item);
            $array_tag->save();
        }
    }
}
