
<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}


/**
 * Permet de supprimer un projet et les données associées.
 *
 * @param int $id_projet
 * @return bool
 */
function supprimer_un_projet($id_projet) {

    if (!$id_projet = intval($id_projet)) {
        echo _T("osi_projets:message_id_erreur_suppression_projet"); 
        return false; 
    }

    sql_updateq('spip_rubriques', array('id_projet' => 0), 'id_projet=' . intval($id_projet));
    sql_delete('spip_auteur_projet', 'id_projet=' . intval($id_projet));
    sql_delete('spip_mots_liens', 'id_objet=' . intval($id_projet) . ' AND objet="projet"');
    sql_delete('spip_projets', 'id_projet=' . intval($id_projet));
    return true;
}


/**
 * Permet de supprimer un auteur d'un projet.
 *
 * @param int $id_auteur
 * @return bool
 */
function supprimer_auteur_projet($id_projet, $id_auteur) {

    $id_auteur_projet = sql_getfetsel("id_auteur_projet", "spip_auteur_projet", "id_projet=" . intval($id_projet) . ' AND id_auteur=' . intval($id_auteur));

    if ($id_auteur_projet == null) {
        echo _T("osi_projets:message_id_erreur_supprimer_auteur_projet"); 
        echo 'id_auteur : ' . $id_auteur_projet;
        echo 'id_projet : ' . $id_projet;
        return false; 
    }

    $etat = sql_getfetsel("etat", "spip_auteur_projet", "id_auteur_projet=" . intval($id_auteur_projet));

    if (intval($etat) == 3) {
        echo _T("osi_projets:message_etat_3_erreur_supprimer_auteur_projet"); 
        return false; 
    }

    sql_delete('spip_auteur_projet', 'id_auteur_projet=' . intval($id_auteur_projet));
    return true;
}



/**
 * Permet de supprimer un rôle.
 *
 * @param int $id_role
 * @return bool
 */

function supprimer_un_role($id_role){
    // Supprimer les liens associés dans la table spip_osip_roles_liens
    sql_delete('spip_osip_roles_liens', 'id_role=' . $id_role);

    // Supprimer le rôle dans la table spip_osip_roles
    sql_delete('spip_osip_roles', 'id_role=' . $id_role);
    return true;
}