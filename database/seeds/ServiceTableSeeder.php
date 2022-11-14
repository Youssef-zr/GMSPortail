<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['libelle' => 'Commercial', "email" => 'commercial@gmsportail.com'],
            ['libelle' => 'comptabilité', "email" => 'compta@gmsportail.com'],
            ['libelle' => 'Exploitation', "email" => 'exploitation@gmsportail.com'],
        ];

        foreach ($services as $service) {
            $new = new Service();
            $new->fill($service)->save();
        }
    }
}
