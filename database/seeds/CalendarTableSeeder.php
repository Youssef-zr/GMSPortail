<?php

use App\Models\Planning;
use Illuminate\Database\Seeder;

class CalendarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $calendars = [
            [
                "email" => "princestartimes10@gmail.com",
                "gToken" => "AIzaSyDMDV-EmJh7GOr5nD0tk5Rhp_XmA_ybJ7M",
                "IDClient" => 1,
            ],
            [
                "email" => "yn.neinaa@gmail.com",
                "gToken" => "AIzaSyDp6f9RGCk56q47kGBmg-26x6dcRVS16QI",
                "IDClient" => 2,
            ],
        ];

        foreach ($calendars as $calendar) {
            $new = new Planning();
            $new->fill($calendar)->save();
        }
    }
}
