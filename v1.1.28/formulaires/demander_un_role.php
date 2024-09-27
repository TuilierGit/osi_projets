<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

function formulaires_demander_un_role_charger_dist($id_projet, $id_auteur, $id_role, $texte_bouton = null) {
    return array(
        'id_projet' => $id_projet,
        'id_auteur' => $id_auteur,
        'id_role' => $id_role,
        'texte_bouton' => $texte_bouton
    );
}

function formulaires_demander_un_role_verifier_dist($id_projet, $id_auteur, $id_role, $texte_bouton = null) {
    $erreurs = array();

    if (empty($id_projet) || !is_numeric($id_projet)) {
        $erreurs['id_projet'] = "L'identifiant du projet est invalide.";
    }

    if (empty($id_auteur) || !is_numeric($id_auteur)) {
        $erreurs['id_auteur'] = "L'identifiant de l'auteur est invalide.";
    }

    if (empty($id_role) || !is_numeric($id_role)) {
        $erreurs['id_role'] = "L'identifiant du rôle est invalide.";
    }

    return $erreurs;
}

function formulaires_demander_un_role_traiter_dist($id_projet, $id_auteur, $id_role, $texte_bouton = null) {
    include_spip("base/abstract_sql");

    $id_projet = intval($id_projet);
    $id_auteur = intval($id_auteur);
    $id_role = intval($id_role);

    $message_ok = '';
    $message_erreur = '';

    // Vérifier si le rôle est actif
    $etat = sql_getfetsel('etat', 'spip_osip_roles', 'id_role=' . $id_role);

    if ($etat >= 1) {
        $id_auteur_projet = sql_getfetsel('id_auteur_projet', 'spip_auteur_projet', 'id_projet=' . $id_projet . ' AND id_auteur=' . $id_auteur);

        if (!$id_auteur_projet) {
            $message_erreur .= "La combinaison auteur-projet n'existe pas.";
            return array('message_erreur' => $message_erreur);
        }

        // Vérifier si le lien existe déjà
        $id_role_lien = sql_getfetsel('id_role_lien', 'spip_osip_roles_liens', 'id_role=' . $id_role . " AND id_auteur_projet=" . $id_auteur_projet);

        if ($id_role_lien) {
            $valeur = sql_getfetsel('valeur', 'spip_osip_roles_liens', 'id_role_lien=' . $id_role_lien);

            if ($valeur == 0) {
                $res = sql_updateq('spip_osip_roles_liens', array('demande' => 1), 'id_role_lien=' . intval($id_role_lien));
                if ($res) {
                    $message_ok .= "La demande de rôle a été mise à jour avec succès.";
                } else {
                    $message_erreur .= "Une erreur s'est produite lors de la mise à jour de la demande de rôle.";
                }
            } else {
                $message_erreur .= "Le rôle est déjà attribué.";
            }
        } else {
            $data_roles = array(
                'id_role' => $id_role,
                'id_auteur_projet' => $id_auteur_projet,
                'valeur' => '0',
                'demande' => '1'
            );

            $res_role = sql_insertq('spip_osip_roles_liens', $data_roles);
            if ($res_role) {
                $message_ok .= "Le lien a été créé avec succès.";
            } else {
                $message_erreur .= "Une erreur s'est produite lors de la création du lien.";
            }
        }


        // Appel de la notification pour informer l'auteur
        if (test_plugin_actif('notifavancees')) {
            $notifications = charger_fonction('notifications', 'inc/');
            $config_demande_role = lire_config('osi_projets/notification/demande_role');
            if ($config_demande_role == 1){
                $notifications('demande_role', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur, 'id_role' => $id_role));
            }
        }


    } else {
        $message_erreur .= "Ce rôle n'est pas activé.";
    }

    // Retour des messages
    return array(
        'message_ok' => $message_ok,
        'message_erreur' => $message_erreur,
    );
}
?>
