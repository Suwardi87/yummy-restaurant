<?php

namespace Database\Seeders;

use App\Models\Chef;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ChefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chef::insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Chef 1',
                'position' => 'Chef',
                'description' => 'Chef 1 description',
                'instagram_link' => 'https://www.instagram.com/',
                'linkedin_link' => 'https://www.linkedin.com/'
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Chef 2',
                'position' => 'Chef',
                'description' => 'Chef 2 description',
                'instagram_link' => 'https://www.instagram.com/',
                'linkedin_link' => 'https://www.linkedin.com/'
            ]
        ]);
    }
}
