



<?php

if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function formulaires_configuration_rubriques_de_creation_charger_dist() {
    return array(
        'rubriques_soumises_g1' => '0',
        'rubriques_soumises_g2' => '0',
    );
}



// Vérifier les valeurs soumises
function formulaires_configuration_rubriques_de_creation_verifier_dist() {
    $erreurs = array();
    return $erreurs;
}


// Traiter les valeurs soumises

function formulaires_configuration_rubriques_de_creation_traiter_dist() {

    $rubriques_soumises_g1 = _request('rubriques_g1');
    $rubriques_soumises_g2 = _request('rubriques_g2');

    $message_ok = "";
    $message_erreur = "";

    include_spip('inc/config');

    // Gestion du groupe 1 
    if ($rubriques_soumises_g1 && $rubriques_soumises_g1 != '0') {
        $configuration_g1 = 'osi_projets/rubriques/' . $rubriques_soumises_g1;
        ecrire_config($configuration_g1, '1');
        $message_ok .= " Modification pour le groupe 1. ($rubriques_soumises_g1)";
    } else {
        $message_ok .= " Aucune modification pour le groupe 1.";
    }


    // Gestion du groupe 2 
    if ($rubriques_soumises_g2  && $rubriques_soumises_g2 != '0') {
        $configuration_g2 = "osi_projets/rubriques/" . $rubriques_soumises_g2;
        ecrire_config($configuration_g2, '0');        
        $message_ok .= " Modification pour le groupe 2. ($rubriques_soumises_g2)";
    } else {
        $message_ok .= " Aucune modification pour le groupe 2.";
    }


    $message_ok .= "test" . lire_config("osi_projets/rubriques/5");

    // Retour des messages
    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : '',
    );
}
