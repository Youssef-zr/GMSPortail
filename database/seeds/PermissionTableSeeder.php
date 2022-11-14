<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            // dashboard stats
            "tableau_bord_index",
            
            // sites
            "sites_index",
            "liste_sites",
            "ajouter_site",
            "editer_site",
            "supprimer_site",
            
            // clients
            "clients_index",
            "liste_clients",
            "ajouter_client",
            "editer_client",
            "supprimer_client",
            "afficher_client_utilisateurs",
            "noveau_utilisateur_client",
            "editer_utilisateur_client",
            "supprimer_utilisateur_client",
            "afficher_client_employes",
            
            // employes
            "employés_index",
            "liste_employés",
            "ajouter_employé",
            "editer_employé",
            "supprimer_employé",

            // documents
            "documents_index",
            "liste_documents",
            "ajouter_document",
            "editer_document",
            "supprimer_document",

            // invoices
            "factures_index",
            "liste_facture",
            "ajouter_facture",
            "editer_facture",
            "supprimer_facture",

            // plannings
            "événements_index",
            "liste_événements",
            "ajouter_événement",
            "afficher_evenement",
            "editer_événement",
            "supprimer_événement",
            "rechercher_événement",

            // tickets
            "tickets_index",
            "liste_tickets",
            "ajouter_ticket",
            "repondre_ticket",
            "fermé_ticket",

            // réglages
            "paramètres_index",
            "editer_paramètres",

            // services
            "liste_services",
            "ajouter_service",
            "editer_service",
            "supprimer_service",

            // priorities
            "liste_priorités",
            "ajouter_priorité",
            "editer_priorité",
            "supprimer_priorité",

            // priorities
            "liste_type_documents",
            "ajouter_type_document",
            "editer_type_document",
            "supprimer_type_document",

            // users
            "utilisateurs_index",
            "liste_utilisateurs",
            "nouveau_utilisateur",
            "editer_utilisateur",
            "supprimer_utilisateur",

            // roles permissions
            "autorisations_index",
            "liste_rôles",
            "nouveau_rôle",
            "editer_rôle",
            "afficher_rôle",
            "supprimer_rôle",
            "nouvelle_autorisation",

            // // parameters
            // "show_site_parameters",

            // // notifications
            // "show_notifications",

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
