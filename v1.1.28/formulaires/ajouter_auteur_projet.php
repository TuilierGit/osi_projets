<?php
if (!defined('_ECRIRE_INC_VERSION')) {
  return;
}

function formulaires_ajouter_auteur_projet_charger_dist($id_projet, $id_auteur) {

    return array(
        'id_projet' => $id_projet,
        'id_auteur' => $id_auteur,
    );  
}


function formulaires_ajouter_auteur_projet_verifier_dist($id_projet, $id_auteur) {
    $erreurs = array();

    if (empty($id_auteur)) {
        $erreurs['id_auteur'] = "L'identifiant de l'auteur est obligatoire";
    }
    if (empty($id_projet)) {
        $erreurs['id_projet'] = "L'identifiant du projet est obligatoire";
    }

    if (!empty($id_auteur) && !empty($id_projet)) {
        $existant = sql_getfetsel('id_auteur_projet', 'spip_auteur_projet', 'id_auteur=' . intval($id_auteur) . ' AND id_projet=' . intval($id_projet));

        if ($existant) {
            // Ceci empèche de faire des demandes en boucle coté utilisateur pour éviter les spams. On est obligé de regarder la variable debug et pas seulement existant car sinon on ne pourrait pas faire de demande dans le cas refusé. 
            $debug_demande = sql_getfetsel('debug_demande', 'spip_auteur_projet', 'id_auteur_projet=' . intval($id_auteur_projet));
            if ($debug_demande == '1'){
                $erreurs['id_auteur'] = "Cette combinaison d'auteur et de projet existe déjà.";
            }

            // $etat_demande = sql_getfetsel('etat', 'spip_auteur_projet', 'id_auteur_projet=' . intval($id_auteur_projet));
            // if ($etat_demande == '-2'){
            //     $erreurs['id_auteur'] = "L'auteur a été banni.";
            // }

        }
  }

  return $erreurs;
}










function formulaires_ajouter_auteur_projet_traiter_dist($id_projet, $id_auteur) {

    $message_ok = '';
    $message_erreur = '';

    include_spip('action/tables/ajouter_dans_tables');
    $id_auteur_projet = ajouter_demande_auteur_projet($id_auteur,$id_projet );
    

    if ($id_auteur_projet) {
        $message_ok .= "L'auteur a été ajouté au projet avec succès.";

        // Récupérer les rôles actifs de la table spip_osip_roles
        $roles_actifs = sql_allfetsel('id_role', 'spip_osip_roles', 'etat=1');

        // Pour chaque rôle, récupérer la valeur du formulaire
        foreach ($roles_actifs as $role) {
            $id_role = $role['id_role'];
            $valeur = _request($id_role);

            $res_role = ajouter_demande_role($id_role,$valeur,$id_auteur_projet );

            $titre = sql_getfetsel('titre', 'spip_osip_roles', 'id_role='.$id_role);

            if (!$res_role) {
                $message_erreur .= "Une erreur s'est produite lors de l'ajout du role : " . $titre;
            } else {
                $message_ok .= "Ajout de la demande du role : " . $titre;
            }
        }


    } else {
        $message_erreur .= "Une erreur s'est produite lors de l'ajout de l'auteur au projet.";
    }

    // Pour éviter le spam de demande
    sql_updateq('spip_auteur_projet', array('debug_demande' => '1'), 'id_auteur_projet=' . $id_auteur_projet);


    // Retourner les messages à afficher dans le formulaire
    return array(
        'message_ok' => isset($message_ok) ? $message_ok : '',
        'message_erreur' => isset($message_erreur) ? $message_erreur : ''
    );
}


?>

