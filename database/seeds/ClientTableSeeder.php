<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            $newClient = new Client();
            $newClient->raison_sociale = "client " . $i;
            $newClient->email = "client" . $i . "@app.com";
            $newClient->phone = random_int(1111111111, 9999999999);
            $newClient->code_client_omag = random_int(500, 9999);
            $newClient->save();
        }
    }
}
