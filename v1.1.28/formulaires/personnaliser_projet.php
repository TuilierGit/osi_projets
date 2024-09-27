<?php
if (!defined('_ECRIRE_INC_VERSION')) {
  return;
}

function formulaires_personnaliser_projet_charger_dist($id_projet) {

    return array(
        'id_projet' => $id_projet,
        'titre' => '',
        'descriptif' => '',
        'texte' => '',
        'date_debut' => '',
        'date_fin' => ''
    );
}


function formulaires_personnaliser_projet_verifier_dist($id_projet) {
    $erreurs = array();


    if (empty($id_projet)) {
        $erreurs['id_projet'] = "L'identifiant du projet est obligatoire";
    }
    
  return $erreurs;
}




function formulaires_personnaliser_projet_traiter_dist($id_projet) {
    $titre = _request('titre');
    $descriptif = _request('descriptif');
    $texte = _request('texte');
    $date_debut = _request('date_debut');
    $date_fin = _request('date_fin');


    $res_rubrique = sql_updateq('spip_rubriques', array(
        'titre' => $titre, 
    ), 'id_projet=' . $id_projet);


    $res = sql_updateq('spip_projets', array(
        'descriptif' => $descriptif, 
        'texte' => $texte, 
        'date_debut' => $date_debut, 
        'date_fin' => $date_fin, 
        'maj' => 'NOW()',
    ), 'id_projet=' . $id_projet);


    // Création de la session
    // $res = sql_insertq('spip_session_projet', array(
    //     'id_projet' => $id_projet,
    //     'titre' => $titre,
    //     'descriptif' => $descriptif,
    //     'texte' => $texte,
    //     'statut' => 'publie',
    //     'etat' => '0',
    //     'date_debut' => $date_debut,
    //     'date_fin' => $date_fin,        
    //     'date' => 'NOW()',
    //     'maj' => 'NOW()',
    // ));


    // Vérification de l'insertion
    if ($res) {
        $message_ok = "Le projet a été modifié avec succès.";

    } else {
        $message_erreur = "Une erreur s'est produite lors de la modification du projet.";
    }

    // Retour des messages
    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : '',
    );
}




?>