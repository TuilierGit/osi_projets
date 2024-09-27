<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

function action_associer_projet_dist() {

    include_spip('action/tables/ajouter_dans_tables');

    // Sécuriser l'action
    $securiser_action = charger_fonction('securiser_action', 'inc');
    $arg = $securiser_action();

    // Récupérer les paramètres depuis l'URL
    list($id_rubrique, $id_auteur) = explode(':', $arg);    

    $verif_id_projet = sql_getfetsel('id_projet', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));

    $verif_statut = sql_getfetsel('statut', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));

    if ($verif_id_projet == 0){

        // Créer le projet
        if ($verif_statut == "publie"){
            $id_projet = ajouter_projet($id_rubrique,$id_auteur , 'publie');
        } else {
            $id_projet = ajouter_projet($id_rubrique,$id_auteur);
        }

        // Retourner le message de succès
        include_spip('inc/headers');
        echo _T('osi_projets:message_succes_projet_associe');

    }  else{
        include_spip('inc/headers');
        echo _T('osi_projets:message_erreur_projet_associe');
    }    
}

