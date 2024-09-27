<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('filtres/verification_aux');



/**
 * Filtre qui permet de vérifier qu’un auteur est le createur du projet.
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */
function filtre_verifier_createur_projet($id_auteur, $id_projet) {
    return verifier_existe_auteur_projet($id_auteur, $id_projet,'3');
}



/**
 * Filtre qui permet de vérifier qu’un auteur est administrateur du projet
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */
function filtre_verifier_administrateur_projet($id_auteur, $id_projet) {
    return verifier_existe_auteur_projet($id_auteur, $id_projet,'2');
}




/**
 * Filtre qui permet de vérifier qu’un auteur est membre du projet.
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */
function filtre_verifier_membre_projet($id_auteur, $id_projet) {
    return verifier_existe_auteur_projet($id_auteur, $id_projet,'1');
}




/**
 * Filtre qui permet de vérifier qu’un auteur est à l'état $etat dans le projet .
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @param int $etat
 * @return bool
 */
function filtre_verifier_etat_dans_projet($id_auteur, $id_projet, $etat) {
    return verifier_existe_auteur_projet($id_auteur, $id_projet,$etat);
}



/**
 * Filtre qui permet de vérifier qu’un auteur appartient au projet (membre, administrateur, createur).
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */
function filtre_verifier_auteur_projet($id_auteur, $id_projet) {
    if (filtre_verifier_membre_projet($id_auteur, $id_projet) || filtre_verifier_administrateur_projet($id_auteur, $id_projet) || filtre_verifier_createur_projet($id_auteur, $id_projet) ){
        return true;
    }
    return false;
}


/**
 * Filtre qui permet de vérifier qu’un auteur a au moins les droits d'administrateur.
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */
function filtre_verifier_droits_projet($id_auteur, $id_projet) {
    if (filtre_verifier_administrateur_projet($id_auteur, $id_projet) || filtre_verifier_createur_projet($id_auteur, $id_projet) ){
        return true;
    }
    return false;
}



/**
 * Filtre qui permet de vérifier les droits nécessaires pour accepter les demandes
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */
function filtre_verifier_droits_demandes_configuration($id_auteur, $id_projet) {
    $osip_config_demandes = lire_config('osip_config_demandes');

    if ($osip_config_demandes == 1){
        return filtre_verifier_droits_projet($id_auteur, $id_projet);
    } else {
        return true; // pas besoin d'être administrateur pour accepter les demandes
    }
}



/**
 * Filtre qui permet de vérifier qu’un auteur à fait une demande pour rejoindre un projet
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */

function filtre_verifier_demande($id_auteur, $id_projet) {
    return verifier_existe_auteur_projet($id_auteur, $id_projet,'0');
}




/**
 * Filtre qui permet de vérifier qu’un auteur à fait une demande qui a été refusé.
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */

function filtre_verifier_demande_echec($id_auteur, $id_projet) {
    return verifier_existe_auteur_projet($id_auteur, $id_projet,'-1');
}




/**
 * Filtre qui permet de vérifier qu'un auteur a été banni du projet..
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */

function filtre_verifier_auteur_banni($id_auteur, $id_projet) {
    return verifier_existe_auteur_projet($id_auteur, $id_projet,'-2');
}




/**
 * Filtre qui permet de vérifier que la rubrique est bien une rubrique d’un projet
 *
 * @param int $id_rubrique
 * @return bool
 */

function filtre_verifier_rubrique_projet($id_rubrique){
    $existe = sql_countsel('spip_rubriques', 'id_rubrique=' . intval($id_rubrique) . ' AND id_projet>0');
    return ($existe > 0);
}




/**
 * Filtre qui permet de vérifier que l’article est bien une session d’un projet
 *
 * @param int $id_article
 * @return bool
 */

 function filtre_verifier_session($id_article){

    // Récupérer l'identifiant de la rubrique parente de l'article
    $id_rubrique = sql_getfetsel('id_rubrique', 'spip_articles', 'id_article=' . intval($id_article));
    
    if (!$id_rubrique) {
        return false;
    }

    return filtre_verifier_rubrique_projet($id_rubrique);
}



// /**
//  * Filtre pour vérifier la configuration 'osi_projets/choix_des_liens/nom_lien'.
//  *
//  * @return bool
//  */
// function filtre_verifier_nom_lien_actif($nom_lien) {
//     return verifier_configuration_valeur('osi_projets/choix_des_liens/',$nom_lien, 1 );
// }



/**
 * Filtre pour vérifier la configuration 'osi_projets/types_de_mots/nom_lien'.
 *
 * @return bool
 */
function filtre_verifier_type_mot_actif($nom_lien) {
    return verifier_configuration_valeur('osi_projets/types_de_mots/',$nom_lien, 1 );
}



/**
 * Filtre pour vérifier la configuration 'osi_projets/types_de_mots/nom_lien'.
 *
 * @return bool
 */
function filtre_verifier_tous_les_types_de_mots() {
    if (verifier_configuration_valeur('osi_projets/types_de_mots/','cause', 1 )){
        return true;
    }
    if (verifier_configuration_valeur('osi_projets/types_de_mots/','condition', 1 )){
        return true;
    }
    if (verifier_configuration_valeur('osi_projets/types_de_mots/','recompense', 1 )){
        return true;
    }
    return false;
}




/**
 * Filtre pour vérifier que les conditions d'un projet sont respectées par l'auteur.
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return bool
 */
function filtre_verifier_conditions_projet($id_auteur, $id_projet) {
    return verifier_conditions_aux($id_auteur, $id_projet, 'projet') && verifier_conditions_inverses_aux($id_auteur, $id_projet, 'projet') ;
}



/**
 * Filtre pour vérifier que les conditions d'un role sont respectées par l'auteur.
 *
 * @param int $id_auteur
 * @param int $id_role
 * @return bool
 */
function filtre_verifier_conditions_role($id_auteur, $id_role) {
    return verifier_conditions_aux($id_auteur, $id_role, 'osip_role') && verifier_conditions_inverses_aux($id_auteur, $id_role, 'osip_role');
}






?>