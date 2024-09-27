



<?php

if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}


function formulaires_modifier_position_du_projet_charger_dist($id_projet) {
    $valeurs = array();
    $valeurs['chemin_rubrique'] = "";
    $valeurs['chemin_id_rubrique'] = sql_getfetsel('id_rubrique', 'spip_projets', 'id_projet=' . intval($id_projet));
    return $valeurs;
}



function formulaires_modifier_position_du_projet_verifier_dist($id_projet) {
    $erreurs = array();

    if (!isset($id_projet)) {
        $erreurs['id_projet'] = "L'identifiant du projet est obligatoire";
    }
    return $erreurs;
}


// Traiter les valeurs soumises
function formulaires_modifier_position_du_projet_traiter_dist($id_projet) {
    $chemin_rubrique = _request('chemin_rubrique');
    $chemin_id_rubrique = _request('chemin_id_rubrique');
    
    if (isset($chemin_id_rubrique)){
        $verification_id_projet_de_la_rubrique = sql_getfetsel('id_projet', 'spip_rubriques', 'id_rubrique=' . intval($chemin_id_rubrique));
        if (intval($verification_id_projet_de_la_rubrique) != 0){
            $message_erreur = "Cette rubrique possède déjà un projet.";
        }
        else {
            ecrire_config('osi_projets/projet-'. $id_projet .'/chemin_rubrique', $chemin_rubrique);
            ecrire_config('osi_projets/projet-'. $id_projet .'/id_chemin_rubrique', $chemin_id_rubrique);

            sql_updateq('spip_rubriques', array('id_projet' => 0), 'id_projet=' . intval($id_projet));
            sql_updateq('spip_rubriques', array('id_projet' => $id_projet), 'id_rubrique=' . intval($chemin_id_rubrique));
            sql_updateq('spip_projets', array('id_rubrique' => $chemin_id_rubrique), 'id_projet=' . intval($id_projet));

            $message_ok = "Le chemin de la rubrique a été enregistré avec succès.";
        }
    }

    // Retour des messages
    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : '',
    );
}
