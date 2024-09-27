<?php
if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Fonction pour vérifier la valeur de l'etat d'une association auteur-projet.
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @param int $valeur
 * @return bool
 */
function verifier_existe_auteur_projet($id_auteur, $id_projet, $valeur) {
    $existe = sql_countsel('spip_auteur_projet', 'id_auteur=' . intval($id_auteur) . ' AND id_projet=' . intval($id_projet) . ' AND etat=' . intval($valeur));
    return ($existe > 0);
}



/**
 * Filtre pour vérifier la configuration '$debut$nom_lien' vaut $valeur
 *
 * @param string $debut
 * @param string $nom_lien
 * @param int $valeur
 * @return bool
 */
function verifier_configuration_valeur($debut, $nom_lien, $valeur) {
    include_spip('inc/config');
    $lien = $debut . $nom_lien;

    if (lire_config($lien) == $valeur) {
        return true;
    }
    return false;
}



function est_webmaster($id_auteur) {
    // Vérifier si l'auteur avec cet id est un webmaster
    if (autoriser('webmestre', '', 0, $id_auteur)) {
        return true;
    } else {
        return false;
    }
}




/**
 * Filtre pour vérifier que les conditions d'un objet (projet ou osip_role) sont respectées par l'auteur.
 *
 * @param int $id_auteur
 * @param int $id_objet
 * @param int $nom_objet
 * @param int $lien_projet (prend la valeur 2 condition)
 * @return bool
 */
function verifier_conditions_aux($id_auteur, $id_objet, $nom_objet, $lien_projet=2, $inv=0) {

    if (verifier_configuration_valeur('osi_projets/','webmaster_droits', 1 )){
        if (est_webmaster($id_auteur) == true){
            echo "Vous êtes un webmaster vous avez les droits";
            return true;
        }
    }
    

    // Récupérer les conditions de l'objet 
    $mots_objet = sql_allfetsel(
        'id_mot',
        'spip_mots_liens',
        'id_objet=' . intval($id_objet) . ' AND objet="' . $nom_objet . '" AND lien_projet=' . $lien_projet
    );


    // Cas où il n'y a aucune condition
    if (empty($mots_objet)) {
        return true; 
    }

    // Cas où il y a des conditions
    
    // Récupérer les mots-clés de l'auteur
    $mots_auteur = sql_allfetsel(
        'id_mot',
        'spip_mots_liens',
        'id_objet=' . intval($id_auteur) . ' AND objet="auteur"'
    );

    // Transformer le résultat en un tableau simple d'IDs de mots-clés
    $mots_objet = array_column($mots_objet, 'id_mot');
    $mots_auteur = array_column($mots_auteur, 'id_mot');

    // Vérifier que tous les mots-clés de l'objet sont dans les mots-clés de l'auteur
    foreach ($mots_objet as $mot) {
        if ( $inv == 0){
            if (!in_array($mot, $mots_auteur)) {
                return false;
            }
        } else {
            if (in_array($mot, $mots_auteur)) {
                return false;
            } 
        }
        
    }
    return true;
}


/**
 * Filtre pour vérifier qu'aucune conditions inverses d'un objet (projet ou osip_role) ne sont respectées par l'auteur.
 *
 * @param int $id_auteur
 * @param int $id_objet
 * @param int $nom_objet
 * @return bool
 */
function verifier_conditions_inverses_aux($id_auteur, $id_objet, $nom_objet) {
    return verifier_conditions_aux($id_auteur, $id_objet, $nom_objet, 4, 1);
}




?>