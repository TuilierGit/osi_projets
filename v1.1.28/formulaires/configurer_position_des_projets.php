



<?php

if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}

// include_spip('inc/config');
// include_spip('inc/filtres');

// Charger les valeurs par défaut du formulaire
function formulaires_configurer_position_des_projets_charger_dist() {
    $valeurs = array();
    $valeurs['chemin_rubrique'] = lire_config('osi_projets/chemin_rubrique', '');
    $valeurs['chemin_id_rubrique'] = lire_config('osi_projets/id_chemin_rubrique', '');
    return $valeurs;
}



// Vérifier les valeurs soumises
function formulaires_configurer_position_des_projets_verifier_dist() {
    $erreurs = array();
    // $chemin_rubrique = _request('chemin_rubrique');

    // if (isset($chemin_rubrique) || $chemin_rubrique == '') {
    //     $erreurs['chemin_rubrique'] = "La sélection d'une rubrique est obligatoire.";
    // }
    return $erreurs;
}


// Traiter les valeurs soumises
function formulaires_configurer_position_des_projets_traiter_dist() {
    $chemin_rubrique = _request('chemin_rubrique');
    $chemin_id_rubrique = _request('chemin_id_rubrique');
    
    if (isset($chemin_rubrique)){
        ecrire_config('osi_projets/chemin_rubrique', $chemin_rubrique);
        ecrire_config('osi_projets/id_chemin_rubrique', $chemin_id_rubrique);
        $message_ok = "Le chemin de la rubrique a été enregistré avec succès.";
    }
    


    // Retour des messages
    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : '',
    );
}
