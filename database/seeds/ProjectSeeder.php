<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\model\Project::truncate();
        
        factory(App\model\Project::class, 100)->create();
    }
}
