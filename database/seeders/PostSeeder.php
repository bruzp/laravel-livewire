<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 20000;
        $chunk_size = 2000;
        $data = [];
        $users = collect(User::all()->modelKeys());

        for ($i = 0; $i < $limit; ++$i) {
            $data[] = [
                'title' => Str::random(10),
                'description' => Str::random(50),
                'slug' => Str::slug(Str::random(rand(10, 50))),
                'user_id' => $users->random(),
                'is_active' => 1,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($data, $chunk_size);

        foreach ($chunks as $chunk) {
            DB::table('posts')->insert($chunk);
        }
    }
}
