<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

function formulaires_changer_champ_projet_charger_dist($id_auteur_projet, $champ, $valeur, $texte_bouton = null) {
    return array(
        'id_auteur_projet' => $id_auteur_projet,
        'champ' => $champ,
        'valeur' => $valeur,
        'texte_bouton' => $texte_bouton
    );
}

function formulaires_changer_champ_projet_verifier_dist($id_auteur_projet, $champ, $valeur, $texte_bouton = null) {
    $erreurs = array();
    return $erreurs;
}

function formulaires_changer_champ_projet_traiter_dist($id_auteur_projet, $champ, $valeur, $texte_bouton = null) {
    
    include_spip("utils.php");
    spip_log("Le champ $champ a été mis à la valeur : $valeur", 'osi_projets' . _LOG_INFO);
    spip_log("Le champ $champ a été mis à la valeur : $valeur");


    // include_spip('inc/autoriser');
    // if (!autoriser('modifier', 'auteur_projet', $id_auteur_projet)) {
    //     return array('message_erreur' => 'Vous n\'avez pas le droit de modifier ce projet.');
    // }

    // Générer l'argument pour l'action
    $arg = $id_auteur_projet . ':' . $champ . ':' . $valeur;

    // Appeler l'action avec l'argument
    // $action_changer_champ_projet = charger_fonction('changer_champ_projet', 'action');
    // $action_changer_champ_projet($arg);

    


    if ($champ == 'etat'){

        $id_auteur = sql_getfetsel('id_auteur', 'spip_auteur_projet', 'id_auteur_projet=' . $id_auteur_projet);
            
        $id_projet = sql_getfetsel('id_projet', 'spip_auteur_projet', 'id_auteur_projet=' . $id_auteur_projet);

        $debug_demande = sql_getfetsel('debug_demande', 'spip_auteur_projet', 'id_auteur_projet=' . $id_auteur_projet);

        // Appel de la notification pour informer l'auteur
        if (test_plugin_actif('notifavancees')) {
            
            $notifications = charger_fonction('notifications', 'inc/');

            $config_demande_projet_resultat = lire_config('osi_projets/notification/demande_projet_resultat');
            $config_nouvel_auteur_projet = lire_config('osi_projets/notification/nouvel_auteur_projet');

            if ($config_demande_projet_resultat == 1){
                if($valeur == "1" && $debug_demande == "1"){
                    $notifications('nouvel_auteur_projet', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur));
                } 
            }
            
            if ($config_demande_projet_resultat == 1){

                if($valeur == "1" && $debug_demande == "1"){
                    $notifications('demande_valide', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur));
                }

                if($valeur == "-1" && $debug_demande == "1"){
                    $notifications('demande_refuse', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur));
                }
            }

            if($debug_demande == "0"){

                // Cas banni
                $config_bannissement_membre = lire_config('osi_projets/notification/bannissement_membre');
                if($valeur == "-2" && $config_bannissement_membre == 1){
                    $notifications('bannissement_membre', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur));
                }

                // Cas exclu
                $config_exclusion_membre = lire_config('osi_projets/notification/exclusion_membre');
                if($valeur == "-1" && $config_exclusion_membre == 1){
                    $notifications('exclusion_membre', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur));
                }

                // Modification de grade
                $config_modification_grade = lire_config('osi_projets/notification/modification_grade');
                if ($config_modification_grade == 1){
                    if($valeur == "1" || $valeur == "2" || $valeur == "3"){
                        $notifications('modification_grade', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur, 'valeur' => $valeur));
                    }
                }   
            }
        }

        sql_updateq('spip_auteur_projet', array('debug_demande' => '0'), 'id_auteur_projet=' . $id_auteur_projet);

    }

    sql_updateq('spip_auteur_projet', array($champ => $valeur), 'id_auteur_projet=' . $id_auteur_projet);

    return array('message_ok' => 'Le champ a été changé avec succès.');
}
?>
