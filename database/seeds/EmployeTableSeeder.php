<?php

use App\Models\Client;
use App\Models\Employe;
use App\Models\Site;
use Illuminate\Database\Seeder;

class EmployeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = Site::pluck('id')->toArray();
        $clients = Client::pluck('id')->toArray();

        for ($i = 1; $i < 10; $i++) {
            $new = new Employe();
            $new->matricule = substr("MT" . time(), 0, 9) . $i;
            $new->nom = "employe " . $i;
            $new->prenom = "prenom employe" . $i;
            $new->cin = "MT" . random_int(1111, 9999);
            $new->cnss = "cnss-" . random_int(1111, 9999);
            $new->IDSite = $sites[array_rand($sites)];
            $new->IDClient = $clients[array_rand($clients)];
            $new->save();
        }

    }
}
