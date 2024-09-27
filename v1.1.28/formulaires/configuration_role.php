<?php
if (!defined('_ECRIRE_INC_VERSION')) {
  return;
}

function formulaires_configuration_role_charger_dist($id_role) {

    return array(
        'id_role' => $id_role,
        'titre' => '',
        'descriptif' => '',
        'question' => ''
    );
}


function formulaires_configuration_role_verifier_dist($id_role) {
    $erreurs = array();
    $titre = _request('titre');


    if (empty($titre)) {
        $erreurs['titre'] = "Le nom du rôle est obligatoire";
    } else {
        $titre_safe = sql_quote($titre);
    
        $existant = sql_getfetsel('id_role', 'spip_osip_roles', 'titre=' . $titre_safe);
    
        if ($existant) {
            if ($existant != $id_role){ // else : On ne change pas de titre
                $erreurs['titre'] = "Ce rôle existe déjà";
            } 
        }
    }
    
  return $erreurs;
}




function formulaires_configuration_role_traiter_dist($id_role) {

    $titre = _request('titre');
    $descriptif = _request('descriptif');
    $question = _request('question');

    $res = sql_updateq('spip_osip_roles', array('titre' => $titre, 'descriptif' => $descriptif, 'question' => $question ), 'id_role=' . intval($id_role));

    if ($res) {
        $message_ok = "Le rôle a été créé avec succès.";
    } else {
        $message_erreur = "Une erreur s'est produite lors de la création du rôle.";
    }

    // Retour des messages
    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : '',
    );
}

