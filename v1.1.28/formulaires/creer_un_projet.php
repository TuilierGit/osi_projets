<?php
if (!defined('_ECRIRE_INC_VERSION')) {
  return;
}

function formulaires_creer_un_projet_charger_dist($id_auteur, $arg_id_rubrique = "-1") {

    return array(
        'titre' => '',
        'texte' => '',
        'modele' => 'projet'
    );
}


function formulaires_creer_un_projet_verifier_dist($id_auteur, $arg_id_rubrique = "-1") {
    $erreurs = array();
    $titre = _request('titre');


    if (empty($id_auteur)) {
        $erreurs['id_auteur'] = "L'identifiant de l'auteur est obligatoire";
    }


    if (empty($titre)) {
        $erreurs['titre'] = "Le nom du projet est obligatoire";
    } else {
        $titre_safe = sql_quote($titre);
    
        $existant = sql_getfetsel('id_rubrique', 'spip_rubriques', 'titre=' . $titre_safe);
    
        if ($existant) {
            $erreurs['titre'] = "Ce projet existe déjà";
        }
    }
    
  return $erreurs;
}




function formulaires_creer_un_projet_traiter_dist($id_auteur, $arg_id_rubrique = "-1") {

    include_spip('action/tables/ajouter_dans_tables');

    $titre = _request('titre');
    $texte = _request('texte');
    $modele = _request('modele');

    if ($modele == 'projet') {

        $verification_active = lire_config('osi_projets/verification_projets');
        if ($verification_active == 0) {
            $id_rubrique = ajouter_rubrique($titre,$texte, 'publie', $arg_id_rubrique);
            $id_projet = ajouter_projet($id_rubrique,$id_auteur , 'publie');
        } else {
            $id_rubrique = ajouter_rubrique($titre,$texte, 'prepa', $arg_id_rubrique );
            $id_projet = ajouter_projet($id_rubrique, $id_auteur);
        }

        // Vérification de l'insertion
        if ($id_projet) {
            $message_ok = "Le projet a été créé avec succès.";

            if (activation_de_la_verification()) {
                $message_ok .= " En attente de la vérification du projet.";
            }
        } else {
            $message_erreur = "Une erreur s'est produite lors de la création du projet.";
        }

    } else {
        $message_erreur = "Le modèle n'est pas valide.";
    }

    // Retour des messages
    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : '',
    );
}




?>