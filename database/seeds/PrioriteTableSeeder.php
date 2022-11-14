<?php

use App\Models\Priorite;
use Illuminate\Database\Seeder;

class PrioriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorites = [
            ["libelle" => 'Haute'],
            ["libelle" => 'Moyenne'],
            ["libelle" => 'Faible'],
        ];

        foreach ($priorites as $priorite) {
            $new = new Priorite();
            $new->fill($priorite)->save();
        }
    }
}
