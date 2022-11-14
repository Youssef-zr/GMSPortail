<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // developpeur role
        $developper = User::create([
            'name' => 'omag dev',
            'email' => 'omag@dev.com',
            'phone' => '0600000022',
            'password' => bcrypt('nbx-de08shah^@@'),
            'roles_name' => ['developpeur'],
            "status" => 'activé',
        ]);

        $role = Role::create(['name' => 'developpeur']);
        $permissions = Permission::pluck('id', 'id')->toArray();
        $role->syncPermissions($permissions);
        $role->revokePermissionTo('ajouter_ticket');
        $role->revokePermissionTo("tableau_bord_index");
        $developper->assignRole([$role->id]);

        // admin role
        $admin = User::create([
            'name' => 'ayoub',
            'email' => 'e.ayoub@mondialservice.ma',
            'phone' => '0600000001',
            'password' => bcrypt('123456'),
            'roles_name' => ['admin'],
            "status" => 'activé',
        ]);

        $role = Role::create(['name' => 'admin']);
        $permissions = Permission::pluck('id', 'id')->toArray();
        $role->syncPermissions($permissions);
        $role->revokePermissionTo('ajouter_ticket');
        $role->revokePermissionTo("tableau_bord_index");
        $admin->assignRole([$role->id]);

        // -----------------------------------------
        //    admin role
        // -----------------------------------------
        $clientUsers = [
            [
                'name' => 'said',
                'email' => 'client1@app.com',
                'phone' => '0600000000',
                'password' => bcrypt('123456'),
                'roles_name' => ['client'],
                "status" => 'activé',
                "IDClient" => 1,
            ],
            [
                'name' => 'rachid',
                'email' => 'client2@app.com',
                'phone' => '0700000000',
                'password' => bcrypt('123456'),
                'roles_name' => ['client'],
                "status" => 'activé',
                "IDClient" => 2,
            ],
        ];

        $clientPermission = [
            // "tableau_bord_index",
            "sites_index",
            "liste_sites",
            "documents_index",
            "liste_documents",
            "factures_index",
            "liste_facture",
            "événements_index",
            "liste_événements",
            "afficher_evenement",
            "tickets_index",
            "liste_tickets",
            "ajouter_ticket",
            "repondre_ticket",
        ];

        $roleAdmin = Role::create(['name' => 'client']);
        $roleAdmin->syncPermissions($clientPermission);

        foreach ($clientUsers as $client) {

            $newAdmin = new User();
            $newAdmin->fill($client)->save();
            $newAdmin->assignRole([$roleAdmin->id]);
        }

    }
}
