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
        $this->call(RoleSeeder::class);
        $this->call(ReportTypeSeeder::class);
        $this->call(ReportStatusSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(GoogleQueriesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
