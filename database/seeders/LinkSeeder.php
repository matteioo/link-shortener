<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('id', 1)->firstOrFail();

        DB::table('links')->insert([
            'url' => 'https://laravel.com',
            'identifier' => 'laravel',
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => $adminUser->id,
        ]);

        Link::factory()->count(50)->for($adminUser)->create();

        Link::factory()->count(10)->for(User::factory()->create())->create();
    }
}
