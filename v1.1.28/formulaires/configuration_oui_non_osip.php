<?php
if (!defined('_ECRIRE_INC_VERSION')) {
  return;
}

function formulaires_configuration_oui_non_osip_charger_dist($nom_configuration) {

    return array(
        'nom_configuration' => '',
        'valeur_configuration' => '',
    );
}


function formulaires_configuration_oui_non_osip_verifier_dist($nom_configuration){
    $erreurs = array();


    if (empty($nom_configuration)) {
        $erreurs['nom_configuration'] = "Le nom de la configuration est obligatoire";
    }
    
    return $erreurs;
}




function formulaires_configuration_oui_non_osip_traiter_dist($nom_configuration) {

    $valeur_lien = _request('valeur_lien');
    // $configuration = lire_config($nom_configuration);
    // $message_ok = "";

    // if ($nom_configuration == 'osip_config_demandes'){
    //     if ($configuration == 1){
    //         ecrire_config('osip_config_demandes', $valeur_lien);
    //     } else {
    //         ecrire_config('osip_config_demandes', $valeur_lien);
    //     }
    //     $message_ok .= "La configuration a été modifié avec succès.";
    // }   


    ecrire_config($nom_configuration, $valeur_lien);
    $message_ok = "La configuration a été modifié avec succès.";

    // Retour des messages
    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : '',
    );
}




?>