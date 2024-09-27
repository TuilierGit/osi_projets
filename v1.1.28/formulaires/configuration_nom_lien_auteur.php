<?php
if (!defined('_ECRIRE_INC_VERSION')) {
  return;
}

function formulaires_configuration_nom_lien_auteur_charger_dist($debut_lien, $nom_lien) {
    $valeurs = array(
        'debut_lien' => '',
        'nom_lien' => lire_config($nom_lien, ''),
    );
    return $valeurs;
}

function formulaires_configuration_nom_lien_auteur_verifier_dist($debut_lien, $nom_lien)  {
    $erreurs = array();
    return $erreurs;
}



function formulaires_configuration_nom_lien_auteur_traiter_dist($debut_lien, $nom_lien){
    $champ_lien = _request('champ_lien');

    include_spip('inc/config');
    if ($champ_lien != ''){
        if ($debut_lien != ''){
            ecrire_config($debut_lien. $nom_lien, $champ_lien);
            $message_ok = 'Le lien a été mis à jour avec succès.';
        }
    }

    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : '',
    );
    
}


?>



