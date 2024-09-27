<?php
if (!defined('_ECRIRE_INC_VERSION')) {
  return;
}

function formulaires_creer_un_role_charger_dist() {

    return array(
        'titre' => '',
        'descriptif' => '',
        'question' => ''
    );
}


function formulaires_creer_un_role_verifier_dist() {
    $erreurs = array();
    $titre = _request('titre');


    if (empty($titre)) {
        $erreurs['titre'] = "Le nom du rôle est obligatoire";
    } else {
        $titre_safe = sql_quote($titre);
    
        $existant = sql_getfetsel('id_role', 'spip_osip_roles', 'titre=' . $titre_safe);
    
        if ($existant) {
            $erreurs['titre'] = "Ce rôle existe déjà";
        }
    }
    
  return $erreurs;
}




function formulaires_creer_un_role_traiter_dist() {

    include_spip('action/tables/ajouter_dans_tables');

    $titre = _request('titre');
    $descriptif = _request('descriptif');
    $question = _request('question');

    $id_role = ajouter_role($titre, $descriptif, $question);

    if ($id_role) {
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

