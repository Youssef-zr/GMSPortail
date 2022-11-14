<?php

use App\Models\TypeDocument;
use Illuminate\Database\Seeder;

class TypeDocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeDocuments = [
            ["libelle" => 'type 1'],
            ["libelle" => 'type 2'],
            ["libelle" => 'type 3'],
        ];

        foreach ($typeDocuments as $type) {
            $new = new TypeDocument();
            $new->fill($type)->save();
        }
    }
}
