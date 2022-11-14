<?php

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sitesList = [
            [
                "libelle" => "ORIFLAME FES",
                "IDClient" => random_int(1, 4),
            ],
            // [
            //     "libelle" => "ORIFLAME LISSASFA",
            //     "IDClient" => random_int(1, 4),
            // ],
            // [
            //     "libelle" => "ORIFLAME MARRAKECH",
            //     "IDClient" => random_int(1, 4),
            // ],
            // [
            //     "libelle" => "ORIFLAME SIEGE",
            //     "IDClient" => random_int(1, 4),
            // ],
            // [
            //     "libelle" => "ORIFLAME TANGER",
            //     "IDClient" => random_int(1, 4),
            // ],
            // [
            //     "libelle" => "ORIFLAME RABAT",
            //     "IDClient" => random_int(1, 4),
            // ],
            // [
            //     "libelle" => "ORIFLAME SEBATA",
            //     "IDClient" => random_int(1, 4),
            // ],
        ];

        foreach ($sitesList as $site) {
            $new = new Site();
            $new->fill($site)->save();
        }
    }
}
