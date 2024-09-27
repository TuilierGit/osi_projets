<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

function formulaires_changer_valeur_role_charger_dist( $id_role, $id_auteur_projet, $valeur, $texte_bouton = null) {
    return array(
        'id_role' => $id_role,
        'id_auteur_projet' => $id_auteur_projet,
        'valeur' => $valeur,
        'texte_bouton' => $texte_bouton
    );
}

function formulaires_changer_valeur_role_verifier_dist( $id_role, $id_auteur_projet, $valeur, $texte_bouton = null) {
    $erreurs = array();
    return $erreurs;
}

function formulaires_changer_valeur_role_traiter_dist( $id_role, $id_auteur_projet, $valeur, $texte_bouton = null) {
    
    include_spip("utils.php");

    $id_role_lien = sql_getfetsel('id_role_lien', 'spip_osip_roles_liens', 'id_role=' . $id_role . ' AND id_auteur_projet=' . $id_auteur_projet);

    if ($id_role_lien){
        $res = sql_updateq('spip_osip_roles_liens', array('valeur' => $valeur,'demande' => 0), 'id_role_lien=' . $id_role_lien);
    } else {
        $res = sql_insertq('spip_osip_roles_liens', array(
            'id_role' => $id_role,
            'id_auteur_projet' => $id_auteur_projet,
            'valeur' => $valeur,
            'demande' => '0'
        ));
    }


    // Appel de la notification pour informer l'auteur
    if (test_plugin_actif('notifavancees')) {
        $id_projet = sql_getfetsel('id_projet', 'spip_auteur_projet', 'id_auteur_projet=' . $id_auteur_projet);
        $notifications = charger_fonction('notifications', 'inc/');
        $config_demande_role_resultat = lire_config('osi_projets/notification/demande_role_resultat');
        if ($config_demande_role_resultat == 1){
            $notifications('demande_role_resultat', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur, 'id_role' => $id_role,'valeur' => $valeur));
        }
    }

    if($res){
        return array('message_ok' => 'Le champ a été changé avec succès.');
    }else {
        return array('message_erreur' => 'Il y a eu un erreur dans la modification du champ');
    }
}
?>
