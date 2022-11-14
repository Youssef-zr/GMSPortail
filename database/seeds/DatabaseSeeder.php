<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(SiteTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EmployeTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(PrioriteTableSeeder::class);
        $this->call(TypeDocumentTableSeeder::class);
        // $this->call(CalendarTableSeeder::class);
    }
}
